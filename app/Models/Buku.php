<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Buku extends Model
{

    use Sluggable;
    use HasFactory;

    public $timestamps = true;
    // nama tabel jika tidak jamak (tanpa s/es)
    public $table = 'buku';

    public $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'sinopsis',
        'kategori_id',
        'gambar',
        'slug'
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
public function isNew()
{
    // Tentukan batasan waktu untuk menentukan apakah buku dianggap baru (2 minggu)
    $batasanWaktu = now()->subWeeks(2);

    return $this->created_at >= $batasanWaktu;
}


public function sluggable(): array
{
    return [
        'slug' => [
            'source' => 'judul'
        ]
    ];
}
}
