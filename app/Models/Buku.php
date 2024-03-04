<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    public $timestamps = false;
    // nama tabel jika tidak jamak (tanpa s/es)
    public $table = 'buku';

    public $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'sinopsis',
        'kategori_id',
        'gambar'
    ];
    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id');
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function ulasan_buku()
{
    return $this->hasMany(UlasanBuku::class);
}
}
