<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->string('tempat_lahir', 100)->nullable()->after('bio');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('pendidikan', 180)->nullable()->after('tanggal_lahir');
            $table->string('alamat', 255)->nullable()->after('pendidikan');
            $table->string('email', 150)->nullable()->after('alamat');
            $table->string('telepon', 30)->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'tanggal_lahir', 'pendidikan', 'alamat', 'email', 'telepon']);
        });
    }
};
