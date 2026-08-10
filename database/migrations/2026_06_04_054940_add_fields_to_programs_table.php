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
        if (!Schema::hasColumn('programs', 'deadline')) {
            Schema::table('programs', function (Blueprint $table) {
                $table->date('deadline')->nullable()->after('target_amount');
            });
        }

        if (!Schema::hasColumn('programs', 'status')) {
            Schema::table('programs', function (Blueprint $table) {
                $table->enum('status', ['draft', 'active', 'closed'])->default('draft')->after('deadline');
            });
        }

        if (!Schema::hasColumn('programs', 'created_by')) {
            Schema::table('programs', function (Blueprint $table) {
                $table->foreignId('created_by')->nullable()->after('status')->constrained('users')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            if (Schema::hasColumn('programs', 'created_by')) {
                $table->dropForeign(['created_by']);
            }
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(array_filter([
                'deadline' => Schema::hasColumn('programs', 'deadline'),
                'status' => Schema::hasColumn('programs', 'status'),
                'created_by' => Schema::hasColumn('programs', 'created_by'),
            ]));
        });
    }
};
