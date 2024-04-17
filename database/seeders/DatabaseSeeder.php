<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            KategoriBukuSeeder::class,
            BukuSeeder::class,
            AdminSeeder::class,
            // Seeder lainnya jika ada
        ]);
        // $this->call(KategoriBukuSeeder::class);
    }
}
