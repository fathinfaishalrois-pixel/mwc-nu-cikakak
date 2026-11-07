<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Schema ini sudah digantikan oleh migrasi 2026_08_31_030000_create_infak_table.
        // Sengaja tidak membuat tabel agar skema lama tidak bertabrakan.
    }

    public function down(): void
    {
        // Intentionally empty: this legacy migration does not own the replacement table.
        // Never remove data created by the newer migration during rollback.
    }
};