<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('organisasi')) {
            Schema::create('organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('ketua')->nullable();
            $table->string('logo')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('organisasi');
    }
};
