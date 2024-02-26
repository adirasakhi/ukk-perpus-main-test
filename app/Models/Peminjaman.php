<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'peminjaman';

    public $fillable = [
        'user_id',
        'buku_id',
        'TanggalPeminjaman',
        'TanggalPengembalian',
        'StatusPeminjaman',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

public function buku()
{
    return $this->belongsTo(Buku::class);
}

public function koleksiPribadi()
{
    return $this->hasOne(KoleksiPribadi::class);
}
}
