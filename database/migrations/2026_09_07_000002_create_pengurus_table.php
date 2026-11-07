<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('jabatan');
            $table->string('bidang')->nullable();
            $table->string('foto')->nullable();
            $table->string('periode', 50)->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->unsignedInteger('urutan')->default(0);
            $table->text('bio')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->boolean('status')->default(true)->index();
            $table->timestamps();
            $table->index(['parent_id', 'urutan']);
        });
    }

    public function down(): void { Schema::dropIfExists('pengurus'); }
};
