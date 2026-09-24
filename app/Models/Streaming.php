<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streaming extends Model
{
    protected $table = 'streaming';

    protected $fillable = [
        'judul',
        'kategori',
        'link_eksternal',
        'deskripsi',
        'thumbnail',
    ];

    // Mutator: Jika link_eksternal kosong, set ke null
    public function setLinkEksternalAttribute($value)
    {
        $this->attributes['link_eksternal'] = ($value === '') ? null : $value;
    }
}