<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyiar extends Model
{
    use HasFactory;
protected $table = 'penyiar';
    protected $fillable = [
        'nama',
        'foto',
        'instagram',
        'bio',
    ];
}