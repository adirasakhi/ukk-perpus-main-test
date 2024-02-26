<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'ken',
                'penulis' => 'Author 2',
                'penerbit' => 'gramedia',
                'tahun_terbit' => 2016,
                'sinopsis' => 'Sinopsis buku Lorem Ipsum Book cauliman.',
            ],
            // Tambahkan data buku lainnya sesuai kebutuhan
        ];

        // Masukkan data buku ke dalam tabel
        DB::table('buku')->insert($books);
    }

}

