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
        // Membuat tabel dengan nama murni 'berita' (tunggal)
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi_berita');
            $table->string('gambar')->nullable();
            
            // Kolom kategori menggunakan string biasa
            $table->string('kategori'); // Mataram Dalam Berita, Berita NTB, atau Berita Internasional
            
            $table->string('penulis')->nullable();
            
            // Kolom status langsung dimasukkan di sini dengan nilai default 'published'
            $table->string('status')->default('published'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};