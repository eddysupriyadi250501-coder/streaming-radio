<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Import yang diperlukan untuk Filament
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Memberikan izin akses ke panel admin
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }

    /**
     * Mengatur ikon/avatar di pojok kanan atas
     * Menggunakan UI Avatars agar otomatis sesuai dengan nama admin
     */
    public function getFilamentAvatarUrl(): ?string
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=FFFFFF&background=f59e0b';
    }
}