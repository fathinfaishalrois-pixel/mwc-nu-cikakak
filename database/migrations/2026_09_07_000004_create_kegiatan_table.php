<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('foto')->nullable();
            $table->date('tanggal')->index();
            $table->string('waktu', 80)->nullable();
            $table->string('lokasi')->nullable();
            $table->text('ringkasan')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kegiatan'); }
};
