<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Ken 2',
                'penulis' => 'Author 2',
                'kategori_id' => '1',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2016,
                'sinopsis' => 'Sinopsis buku Lorem Ipsum Book cauliman.',
            ],
            // Tambahkan data buku lainnya sesuai kebutuhan
        ];

        // Masukkan data buku ke dalam tabel
        foreach ($books as $bookData) {
            $slug = SlugService::createSlug('App\Models\Buku', 'slug', $bookData['judul']);

            $book = array_merge($bookData, ['slug' => $slug]);

            DB::table('buku')->insert($book);
        }
    }
}
