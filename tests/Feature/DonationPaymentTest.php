<?php

use App\Models\Program;
use App\Models\Donation;
use App\Models\PaymentTransaction;

beforeEach(function () {
    config(['midtrans.server_key' => 'SB-Mid-server-TESTKEY123']);
    config(['midtrans.client_key' => 'SB-Mid-client-TESTKEY123']);
    config(['midtrans.is_production' => false]);
});

it('shows admin fee and total amount on the success receipt', function () {
    \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys = OFF');

    $program = Program::create([
        'title' => 'Bantuan Pendidikan',
        'slug' => 'bantuan-pendidikan',
        'category' => 'Pendidikan',
        'target_amount' => 50000000,
        'collected' => 0,
    ]);

    $donation = Donation::create([
        'program_id' => $program->id,
        'donor_name' => 'Donatur Admin',
        'donor_email' => 'admin@test.com',
        'donor_phone' => '081234567890',
        'amount' => 25000,
        'admin_fee' => 4000,
        'payment_method' => 'va_bri',
        'status' => 'paid',
        'paid_at' => now(),
    ]);

    PaymentTransaction::create([
        'donation_id' => $donation->id,
        'gateway_name' => 'midtrans',
        'order_id' => 'LAZ-TEST-ORDER-789',
        'gross_amount' => 29000,
        'transaction_status' => 'settlement',
    ]);

    $response = $this->get(route('donasi.finish', ['order_id' => 'LAZ-TEST-ORDER-789']));

    $response->assertStatus(200);
    $response->assertSee('Biaya Admin');
    $response->assertSee('Rp 4.000');
    $response->assertSee('Rp 29.000');
});

it('creates a pending donation with manual transfer method', function () {
    // Disable FK checks for SQLite in-memory
    \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys = OFF');

    $program = Program::create([
        'title' => 'Zakat Maal',
        'slug' => 'zakat-maal',
        'description' => 'Test Description',
        'category' => 'Zakat',
        'target_amount' => 50000000,
        'collected' => 0,
    ]);

    $response = $this->postJson(route('donasi.store'), [
        'nama' => 'Donatur Test',
        'email' => 'donatur@test.com',
        'telepon' => '081234567890',
        'amount' => 100000,
        'payment_method' => 'transfer_manual',
        'program_slug' => 'zakat-maal',
        'doa' => 'Semoga berkah',
    ]);

    $response->assertStatus(200);
    $response->assertJson(['status' => 'manual']);
    $response->assertJsonStructure(['status', 'redirect_url']);

    $this->assertDatabaseHas('donations', [
        'donor_name' => 'Donatur Test',
        'donor_email' => 'donatur@test.com',
        'amount' => 100000,
        'payment_method' => 'transfer_manual',
        'status' => 'pending',
    ]);

    $this->assertDatabaseHas('payment_transactions', [
        'gateway_name' => 'manual',
        'gross_amount' => 100000,
        'transaction_status' => 'pending',
    ]);
});

it('marks donation as paid when midtrans sends settlement notification', function () {
    \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys = OFF');

    $program = Program::create([
        'title' => 'Zakat Fitrah',
        'slug' => 'zakat-fitrah',
        'category' => 'Zakat',
        'target_amount' => 50000000,
        'collected' => 0,
    ]);

    $donation = Donation::create([
        'program_id' => $program->id,
        'donor_name' => 'Donatur Auto',
        'donor_email' => 'auto@test.com',
        'donor_phone' => '081234567890',
        'amount' => 50000,
        'payment_method' => 'va_bni',
        'status' => 'pending',
    ]);

    $orderId = 'LAZ-TEST-ORDER-123';
    $transaction = PaymentTransaction::create([
        'donation_id' => $donation->id,
        'gateway_name' => 'midtrans',
        'order_id' => $orderId,
        'gross_amount' => 50000,
        'transaction_status' => 'pending',
    ]);

    // Calculate expected signature
    $statusCode = '200';
    $grossAmount = '50000.00';
    $serverKey = config('midtrans.server_key');
    $signatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

    $response = $this->postJson(route('payment.notification'), [
        'order_id' => $orderId,
        'status_code' => $statusCode,
        'gross_amount' => $grossAmount,
        'signature_key' => $signatureKey,
        'transaction_status' => 'settlement',
        'payment_type' => 'bank_transfer',
        'transaction_id' => 'midtrans-trans-id-999',
        'fraud_status' => 'accept',
    ]);

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Notification handled successfully']);

    $donation->refresh();
    expect($donation->status)->toBe('paid');
    expect($donation->paid_at)->not->toBeNull();

    $program->refresh();
    expect((float) $program->collected)->toBe(50000.0);

    $transaction->refresh();
    expect($transaction->transaction_status)->toBe('settlement');
    expect($transaction->transaction_id)->toBe('midtrans-trans-id-999');
});

it('rejects notification with invalid signature key', function () {
    $response = $this->postJson(route('payment.notification'), [
        'order_id' => 'LAZ-FAKE-ORDER',
        'status_code' => '200',
        'gross_amount' => '100000.00',
        'signature_key' => 'invalid-fake-signature',
        'transaction_status' => 'settlement',
    ]);

    $response->assertStatus(400);
    $response->assertJson(['message' => 'Invalid signature']);
});
