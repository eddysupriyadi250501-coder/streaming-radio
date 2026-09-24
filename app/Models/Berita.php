<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Menghubungkan ke tabel 'berita' di database Anda
    protected $table = 'berita';

    // Mendefinisikan kolom yang bisa diisi
    protected $fillable = [
        'judul', 
        'slug', 
        'isi_berita', 
        'gambar', 
        'kategori', 
        'penulis', 
        'status'
    ];
}