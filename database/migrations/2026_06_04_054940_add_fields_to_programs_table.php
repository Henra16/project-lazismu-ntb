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
        Schema::table('programs', function (Blueprint $table) {
            $table->date('deadline')
              ->nullable()
              ->after('target_amount');

        $table->enum('status', ['draft', 'active', 'closed'])
              ->default('draft')
              ->after('deadline');

        $table->foreignId('created_by')
              ->nullable()
              ->after('status')
              ->constrained('users')
              ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['created_by']);

        $table->dropColumn([
            'deadline',
            'status',
            'created_by'
        ]);
        });
    }
};
