<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('warga_nu')) {
            Schema::create('warga_nu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 32)->nullable()->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat')->nullable();
            $table->string('dusun')->nullable();
            $table->string('desa')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('warga_nu');
    }
};
