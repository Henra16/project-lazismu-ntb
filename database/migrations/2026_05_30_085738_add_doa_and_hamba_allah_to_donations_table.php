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
        Schema::table('donations', function (Blueprint $table) {
            $table->text('doa')->nullable()->after('user_agent')->comment('Doa atau pesan dukungan dari donatur');
            $table->boolean('is_anonymous')->default(false)->after('doa')->comment('Sembunyikan nama sebagai Hamba Allah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['doa', 'is_anonymous']);
        });
    }
};
