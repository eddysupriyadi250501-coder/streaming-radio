<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // Pastikan ini sesuai dengan nama tabel di database Anda
    protected $table = 'layanan'; 

    // Ini adalah daftar kolom yang diizinkan untuk diisi (Mass Assignment)
    protected $fillable = [
        'kategori',
        'judul',
        'deskripsi',
        'link_external',
        'nomor_telepon',
        'tipe_kontak',
        'email', // Ini field baru yang kita buat untuk Call Center
    ];
}