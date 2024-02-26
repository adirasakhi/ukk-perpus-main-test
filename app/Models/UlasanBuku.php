<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanBuku extends Model
{
    use HasFactory;
    protected $table = 'ulasanbuku';

    protected $fillable = [
        'user_id',
        'buku_id',
        'Ulasan',
        'Rating'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
