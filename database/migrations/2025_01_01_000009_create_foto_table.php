<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Legacy migration intentionally left empty. The `foto` table is created
        // by 2026_09_07_000008_create_foto_table.php after `galeri` exists.
    }

    public function down(): void
    {
        // The replacement migration owns the `foto` table lifecycle.
    }
};
