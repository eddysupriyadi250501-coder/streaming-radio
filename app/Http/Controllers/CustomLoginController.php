<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    // Pastikan namanya TIDAK ADA TYPO
   public function loginProses(Request $request) {
    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember'); // Cek apakah checkbox dicentang

    if (Auth::attempt($credentials, $remember)) { // Masukkan variabel $remember di sini
        $request->session()->regenerate();
        return redirect('/admin');
    }

    return back()->withErrors(['email' => 'Email atau Password salah!']);
}
}