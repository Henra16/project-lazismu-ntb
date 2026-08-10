<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan foreign key constraint dari payment_transactions ke donations.
     *
     * Migration ini dipisah karena payment_transactions dibuat sebelum
     * tabel donations ada (2026_02_25 vs 2026_05_18).
     */
    public function up(): void
    {
        // Pastikan kolom belum punya FK (idempotent)
        Schema::table('payment_transactions', function (Blueprint $table) {
            // Drop index biasa dulu jika ada, lalu tambah FK
            try {
                $table->dropIndex(['donation_id']);
            } catch (\Exception $e) {
                // Abaikan jika index tidak ada
            }

            $table->foreign('donation_id')
                  ->references('id')
                  ->on('donations')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            try {
                $table->dropForeign(['donation_id']);
            } catch (\Exception $e) {
                // Abaikan jika tidak ada
            }

            // Tambahkan kembali index biasa
            $table->index('donation_id');
        });
    }
};
