<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;
protected $table = 'umkm';
    protected $fillable = [
        'nama_usaha',
        'kategori',
        'pemilik',
        'alamat',
        'no_hp',
        'instagram',
        'gambar',
        'deskripsi',
        'maps_url', // Tambahkan ini agar sinkron dengan SQL dan Controller
    ];
}