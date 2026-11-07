<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('infak')) {
            Schema::create('infak', function (Blueprint $table) {
            $table->id();
            $table->enum('program', ['koin_nu', 'infak_umum'])->default('koin_nu');
            $table->string('nama_donatur');
            $table->string('no_hp')->nullable();
            $table->string('dusun')->nullable();
            $table->string('desa')->nullable();
            $table->unsignedBigInteger('jumlah');
            $table->enum('metode', ['tunai', 'transfer', 'qris'])->default('tunai');
            $table->text('catatan')->nullable();
            $table->string('bukti')->nullable();
            $table->enum('status', ['pending', 'terverifikasi'])->default('pending');
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('infak');
    }
};
