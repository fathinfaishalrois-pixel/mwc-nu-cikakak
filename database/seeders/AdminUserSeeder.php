<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seeder pengembangan untuk membuat akun admin awal.
     * Ganti email dan password ini sebelum digunakan di production.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mwc-nu-cikakak.test'],
            [
                'name' => 'Admin MWC NU Cikakak',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
