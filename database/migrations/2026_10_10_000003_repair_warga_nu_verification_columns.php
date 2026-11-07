<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Repair migration for databases where the verification migration was
     * recorded as complete but one or both columns are missing.
     * Safe to run on SQLite and MySQL because each column is checked first.
     */
    public function up(): void
    {
        if (! Schema::hasTable('warga_nu')) {
            return;
        }

        if (! Schema::hasColumn('warga_nu', 'verification_status')) {
            Schema::table('warga_nu', function (Blueprint $table): void {
                $table->string('verification_status', 20)->default('approved');
            });
        }

        if (! Schema::hasColumn('warga_nu', 'rejection_reason')) {
            Schema::table('warga_nu', function (Blueprint $table): void {
                $table->text('rejection_reason')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Intentionally non-destructive: this repair may have restored columns
        // needed by live data and must not remove them during rollback.
    }
};
