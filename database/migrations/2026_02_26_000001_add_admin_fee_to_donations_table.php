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
        if (!Schema::hasTable('donations')) {
            return;
        }

        if (!Schema::hasColumn('donations', 'admin_fee')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->decimal('admin_fee', 15, 2)->default(0)->after('amount');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('donations', 'admin_fee')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropColumn('admin_fee');
            });
        }
    }
};
