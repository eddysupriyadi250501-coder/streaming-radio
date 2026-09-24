<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SekolahKita extends Model
{
    protected $table = 'sekolah_kita'; // Pastikan ini sesuai dengan nama tabel di database Anda
    protected $fillable = [
    'judul',
    'asal_sekolah',
    'kategori',
    'deskripsi',
    'gambar',
    'prestasi',
];
}
