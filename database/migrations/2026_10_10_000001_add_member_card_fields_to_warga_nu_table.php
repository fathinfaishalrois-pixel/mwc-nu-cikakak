<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warga_nu', function (Blueprint $table) {
            $table->string('card_code', 20)->nullable()->unique();
            $table->string('profile_token', 64)->nullable()->unique();
        });
    }

    public function down(): void
    {
        Schema::table('warga_nu', function (Blueprint $table) {
            $table->dropUnique(['card_code']);
            $table->dropUnique(['profile_token']);
            $table->dropColumn(['card_code', 'profile_token']);
        });
    }
};
