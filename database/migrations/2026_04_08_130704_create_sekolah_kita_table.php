<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TAMBAHKAN PENGECEKAN INI:
        if (!Schema::hasTable('sekolah_kita')) {
            Schema::create('sekolah_kita', function (Blueprint $table) {
                $table->id();
                $table->string('judul'); // Nama kegiatan atau nama siswa
                $table->string('asal_sekolah');
                $table->enum('kategori', ['ekstrakurikuler', 'siswa', 'ukm']);
                $table->text('deskripsi');
                $table->string('gambar')->nullable();
                $table->string('prestasi')->nullable(); // Khusus untuk kategori Siswa
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_kita');
    }
};