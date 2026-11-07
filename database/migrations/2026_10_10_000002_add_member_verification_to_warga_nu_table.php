<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('warga_nu')) {
            Schema::table('warga_nu', function (Blueprint $table) {
                if (!Schema::hasColumn('warga_nu', 'verification_status')) $table->string('verification_status', 20)->default('approved');
                if (!Schema::hasColumn('warga_nu', 'rejection_reason')) $table->text('rejection_reason')->nullable();
            });
        }
    }
    public function down(): void {
        if (Schema::hasTable('warga_nu')) Schema::table('warga_nu', function (Blueprint $table) {
            if (Schema::hasColumn('warga_nu', 'rejection_reason')) $table->dropColumn('rejection_reason');
            if (Schema::hasColumn('warga_nu', 'verification_status')) $table->dropColumn('verification_status');
        });
    }
};
