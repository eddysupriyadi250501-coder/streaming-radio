<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    protected static string $view = 'filament.pages.auth.login';

    // Tambahkan baris ini agar "Remember Me" muncul
    protected function hasRememberFormAction(): bool
    {
        return true;
    }
}