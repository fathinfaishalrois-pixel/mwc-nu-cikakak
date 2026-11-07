<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori', 100);
            $table->string('thumbnail')->nullable();
            $table->text('ringkasan')->nullable();
            $table->longText('isi');
            $table->string('penulis', 120)->nullable();
            $table->date('tanggal')->index();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('berita'); }
};
