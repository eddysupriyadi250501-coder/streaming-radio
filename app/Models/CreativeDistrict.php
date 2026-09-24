<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeDistrict extends Model
{
    use HasFactory;

    protected $table = 'creative_district'; // Pastikan nama tabel sesuai dengan yang ada di database
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'lokasi',
        'link_maps', // Tambahkan ini agar bisa disimpan
        'kontak',
        'tanggal_event',
        'gambar',
        'link_external',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'tanggal_event' => 'date',
    ];
}