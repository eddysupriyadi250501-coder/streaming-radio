<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Mail\PermintaanDarahMail;
use Illuminate\Support\Facades\Mail;

class PermintaanController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $data = $request->validate([
            'nama_pasien'     => 'required|string',
            'golongan_darah'  => 'required|string',
            'rhesus'          => 'required|string',
            'jumlah_kantong'  => 'required|integer',
            'rumah_sakit'     => 'required|string',
            'kontak_keluarga' => 'required|string',
            'kontak_pribadi'  => 'required|string',
        ]);

        // 2. Ambil data layanan (email tujuan)
        $tujuan = Layanan::first();

        if (!$tujuan || empty($tujuan->email)) {
            return back()->with('error', 'Email tujuan tidak ditemukan di database.');
        }

        // 3. Kirim Email
        try {
            Mail::to($tujuan->email)->send(new PermintaanDarahMail($data));
            return back()->with('success', 'Permintaan berhasil dikirim!');
        } catch (\Exception $e) {
            // Jika gagal, tampilkan error (PENTING untuk debugging)
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}