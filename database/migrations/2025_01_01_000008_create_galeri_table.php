<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Skema lama ini digantikan migrasi 2026_09_07_*. Sengaja dikosongkan agar
        // `migrate` pada database baru tidak membuat tabel dengan kolom yang salah.
    }

    public function down(): void
    {
        // Intentionally empty: this legacy migration does not own the replacement table.
        // Never remove data created by the newer migration during rollback.
    }
};
