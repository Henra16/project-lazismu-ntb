<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\PaymentTransaction;
use App\Models\Program;
use App\Services\TripayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function __construct(protected TripayService $tripay) {}

    /**
     * Store a newly created donation and initiate Tripay payment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:100',
            'email'          => 'required|email|max:150',
            'telepon'        => 'required|string|max:20',
            'amount'         => 'required|numeric|min:1000',
            'payment_method' => 'required|string',
            'program_slug'   => 'nullable|string',
            'doa'            => 'nullable|string|max:500',
            'hamba_allah'    => 'nullable|integer|in:0,1',
        ]);

        // Resolve program
        $program = null;
        if ($request->program_slug) {
            $program = Program::where('slug', $request->program_slug)->first();
            if (!$program) {
                return response()->json(['message' => 'Program tidak ditemukan.'], 404);
            }
        } else {
            $program = Program::where('is_active', true)->first();
            if (!$program) {
                return response()->json(['message' => 'Tidak ada program yang tersedia.'], 404);
            }
        }

        $paymentMethod = $request->payment_method;

        // Handle Transfer Manual — tidak melalui Tripay
        if ($paymentMethod === 'transfer_manual') {
            DB::beginTransaction();
            try {
                $donation = Donation::create([
                    'user_id'      => Auth::user()?->id,
                    'program_id'   => $program->id,
                    'donor_name'   => $request->nama,
                    'donor_email'  => $request->email,
                    'donor_phone'  => $request->telepon,
                    'amount'       => $request->amount,
                    'admin_fee'    => 0,
                    'payment_method' => 'transfer_manual',
                    'status'       => 'pending',
                    'ip_address'   => $request->ip(),
                    'user_agent'   => $request->userAgent(),
                    'doa'          => $request->doa,
                    'is_anonymous' => $request->hamba_allah ? true : false,
                ]);

                $orderId = 'LAZ-' . date('YmdHis') . '-' . strtoupper(Str::random(5));

                PaymentTransaction::create([
                    'donation_id'        => $donation->id,
                    'gateway_name'       => 'manual',
                    'order_id'           => $orderId,
                    'gross_amount'       => $donation->amount,
                    'transaction_status' => 'pending',
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error creating manual donation: ' . $e->getMessage());
                return response()->json(['message' => 'Gagal memproses donasi, silakan coba lagi.'], 500);
            }

            return response()->json([
                'status'       => 'manual',
                'redirect_url' => route('donasi.manual', $donation->uuid),
            ]);
        }

        // Tripay payment flow
        $adminFee    = TripayService::calculateAdminFee($paymentMethod, (int) $request->amount);
        $grossAmount = (int) $request->amount + $adminFee;
        $channelCode = TripayService::mapChannel($paymentMethod);

        DB::beginTransaction();
        try {
            $donation = Donation::create([
                'user_id'        => Auth::user()?->id,
                'program_id'     => $program->id,
                'donor_name'     => $request->nama,
                'donor_email'    => $request->email,
                'donor_phone'    => $request->telepon,
                'amount'         => $request->amount,
                'admin_fee'      => $adminFee,
                'payment_method' => $paymentMethod,
                'status'         => 'pending',
                'ip_address'     => $request->ip(),
                'user_agent'     => $request->userAgent(),
                'doa'            => $request->doa,
                'is_anonymous'   => $request->hamba_allah ? true : false,
            ]);

            $orderId = 'LAZ-' . date('YmdHis') . '-' . strtoupper(Str::random(5));

            $transaction = PaymentTransaction::create([
                'donation_id'        => $donation->id,
                'gateway_name'       => 'tripay',
                'order_id'           => $orderId,
                'gross_amount'       => $grossAmount,
                'transaction_status' => 'pending',
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating donation: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memproses donasi, silakan coba lagi.'], 500);
        }

        // Buat transaksi ke Tripay
        try {
            $tripayData = $this->tripay->createTransaction([
                'channel_code'   => $channelCode,
                'merchant_ref'   => $orderId,
                'amount'         => $grossAmount,
                'customer_name'  => $donation->donor_name,
                'customer_email' => $donation->donor_email,
                'customer_phone' => $donation->donor_phone,
                'order_items'    => [
                    [
                        'sku'      => $program->slug,
                        'name'     => 'Donasi: ' . substr($program->title, 0, 50),
                        'price'    => (int) $donation->amount,
                        'quantity' => 1,
                    ],
                    ...($adminFee > 0 ? [[
                        'sku'      => 'ADMIN_FEE',
                        'name'     => 'Biaya Admin',
                        'price'    => $adminFee,
                        'quantity' => 1,
                    ]] : []),
                ],
                'callback_url' => route('payment.tripay.callback'),
                'return_url'   => route('donasi.track', $donation->uuid),
            ]);

            // Simpan reference & payment URL dari Tripay
            $transaction->update([
                'transaction_id'  => $tripayData['reference'] ?? null,
                'raw_response'    => $tripayData,
            ]);

            return response()->json([
                'status'      => 'tripay',
                'payment_url' => $tripayData['checkout_url'],
                'reference'   => $tripayData['reference'],
            ]);

        } catch (\Exception $e) {
            Log::error('Tripay Transaction Creation Failed: ' . $e->getMessage());
            // Rollback donation jika Tripay gagal
            $donation->delete();
            $transaction->delete();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Tripay Callback (Webhook) handler.
     * Tripay mengirim POST ke URL ini saat status pembayaran berubah.
     */
    public function tripayCallback(Request $request)
    {
        // Ambil raw body untuk verifikasi signature
        $rawBody          = $request->getContent();
        $receivedSignature = $request->header('X-Callback-Signature');

        Log::info('Tripay Callback Received', [
            'signature' => $receivedSignature,
            'body'      => $rawBody,
        ]);

        // Verifikasi signature
        if (!$this->tripay->verifyCallbackSignature($rawBody, $receivedSignature)) {
            Log::warning('Tripay Callback: Invalid Signature!', [
                'received' => $receivedSignature,
            ]);

            if (config('tripay.is_production')) {
                return response()->json(['message' => 'Invalid signature'], 400);
            }
            // Di sandbox: log dan lanjut
        }

        $payload = json_decode($rawBody, true);

        if (!$payload) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $merchantRef = $payload['merchant_ref'] ?? null;
        $status      = $payload['status'] ?? null;         // PAID / EXPIRED / FAILED / UNPAID
        $tripayRef   = $payload['reference'] ?? null;

        Log::info('Tripay Callback Payload', [
            'merchant_ref' => $merchantRef,
            'status'       => $status,
            'reference'    => $tripayRef,
        ]);

        DB::beginTransaction();
        try {
            $transaction = PaymentTransaction::where('order_id', $merchantRef)->first();
            if (!$transaction) {
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            $donation = $transaction->donation;
            if (!$donation) {
                return response()->json(['message' => 'Donation not found'], 404);
            }

            // Map status Tripay ke status internal
            $donationStatus = match ($status) {
                'PAID'    => 'paid',
                'EXPIRED' => 'expired',
                'FAILED'  => 'failed',
                default   => 'pending',
            };
            $paidAt = ($donationStatus === 'paid') ? now() : null;

            // Update donation
            $donation->update([
                'status'  => $donationStatus,
                'paid_at' => $paidAt ?? $donation->paid_at,
            ]);

            // Update transaction
            $transaction->update([
                'transaction_id'     => $tripayRef,
                'transaction_status' => strtolower($status),
                'raw_response'       => $payload,
            ]);

            // Increment program collected jika berhasil bayar
            if ($donationStatus === 'paid' && $donation->wasChanged('status')) {
                $program = $donation->program;
                if ($program) {
                    $program->increment('collected', $donation->amount);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Callback handled successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error handling Tripay callback: ' . $e->getMessage());
            return response()->json(['message' => 'Error handling callback'], 500);
        }
    }

    /**
     * Finish / Return URL setelah pembayaran Tripay.
     */
    public function finish(Request $request)
    {
        $orderId = $request->order_id;
        $transaction = PaymentTransaction::where('order_id', $orderId)
            ->with('donation.program')
            ->first();

        $donation = $transaction?->donation;

        return view('frontend.donasi.success', compact('donation', 'orderId'));
    }

    /**
     * Display the manual transfer instructions page.
     */
    public function manualInstructions($uuid)
    {
        $donation = Donation::where('uuid', $uuid)->with('program')->firstOrFail();

        $bankDetails = [
            'bank_name'      => env('MANUAL_BANK_NAME', 'Bank NTB Syariah'),
            'account_number' => env('MANUAL_BANK_ACCOUNT', '504-02-12345-67-8'),
            'account_name'   => env('MANUAL_BANK_RECIPIENT', 'LAZISMU NTB'),
        ];

        return view('frontend.donasi.manual', compact('donation', 'bankDetails'));
    }

    /**
     * Unfinish Redirect Page (user tutup sebelum selesai).
     */
    public function unfinish(Request $request)
    {
        return redirect()->route('donasi')->with('warning', 'Pembayaran Anda belum selesai. Silakan cek m-banking / e-wallet Anda.');
    }

    /**
     * Error Redirect Page.
     */
    public function error(Request $request)
    {
        return redirect()->route('donasi')->with('error', 'Pembayaran Anda gagal atau dibatalkan. Silakan coba kembali.');
    }
}
