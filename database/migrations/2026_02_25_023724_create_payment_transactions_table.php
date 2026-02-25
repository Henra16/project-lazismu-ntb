<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')
                  ->constrained('donations')
                  ->cascadeOnDelete();

            $table->string('gateway_name', 50)->default('midtrans');
            $table->string('transaction_id', 100)->nullable();
            $table->string('order_id', 100)->unique();

            $table->decimal('gross_amount', 15, 2);
            $table->string('payment_type', 50)->nullable();
            $table->string('transaction_status', 50)->nullable();
            $table->string('fraud_status', 50)->nullable();

            $table->text('signature_key')->nullable();
            $table->json('raw_response')->nullable();

            $table->timestamps();

            $table->index('transaction_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
