<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Make migration idempotent: only rename if old column exists
        if (Schema::hasColumn('donations', 'campaign_id')) {
            Schema::table('donations', function (Blueprint $table) {
                if (DB::getDriverName() !== 'sqlite') {
                    // attempt to drop existing foreign key if present
                    try {
                        $table->dropForeign(['campaign_id']);
                    } catch (\Exception $e) {
                        // ignore if foreign does not exist
                    }
                }
                $table->renameColumn('campaign_id', 'program_id');
            });

            Schema::table('donations', function (Blueprint $table) {
                if (!Schema::hasColumn('donations', 'program_id')) {
                    return;
                }
                $table->foreign('program_id')
                      ->references('id')
                      ->on('programs')
                      ->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('donations', 'program_id')) {
            Schema::table('donations', function (Blueprint $table) {
                if (DB::getDriverName() !== 'sqlite') {
                    try {
                        $table->dropForeign(['program_id']);
                    } catch (\Exception $e) {
                        // ignore
                    }
                }
                $table->renameColumn('program_id', 'campaign_id');
            });

            Schema::table('donations', function (Blueprint $table) {
                if (!Schema::hasColumn('donations', 'campaign_id')) {
                    return;
                }
                $table->foreign('campaign_id')
                      ->references('id')
                      ->on('campaigns')
                      ->cascadeOnDelete();
            });
        }
    }
};
