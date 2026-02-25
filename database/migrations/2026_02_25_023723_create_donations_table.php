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
         Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->foreignId('campaign_id')
                  ->constrained('campaigns')
                  ->cascadeOnDelete();

            $table->string('donor_name', 100);
            $table->string('donor_email', 150);
            $table->string('donor_phone', 20)->nullable();

            $table->decimal('amount', 15, 2);
            $table->string('payment_method', 50)->nullable();

            $table->enum('status', ['pending','paid','failed','expired'])
                  ->default('pending');

            $table->timestamp('paid_at')->nullable();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index(['campaign_id', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
