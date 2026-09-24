<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@suarakota.com'], 
            [
                'name' => 'Admin Suara Kota',
                'password' => Hash::make('password123'),
            ]
        );

        // Memberikan pesan di terminal agar Anda tahu proses ini berhasil
        $this->command->info('Admin user created successfully.');
    }
}