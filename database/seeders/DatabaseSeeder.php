<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil AdminSeeder di sini
        $this->call([
            AdminSeeder::class,
        ]);
    }
}