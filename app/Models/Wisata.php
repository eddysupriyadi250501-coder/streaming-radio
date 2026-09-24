<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
protected $table = 'wisata';
   protected $fillable = [
    'nama_wisata',
    'kategori',
    'lokasi',
    'deskripsi',
    'harga_tiket',
    'jam_operasional',
    'gambar',
    'maps_url',
];
}