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
        Schema::create('creative_district', function (Blueprint $table) {
    $table->id();
    $table->string('nama'); // Nama Komunitas/Band/Judul Film
    $table->enum('kategori', ['komunitas', 'musisi', 'seniman', 'event', 'film']);
    $table->text('deskripsi');
    $table->string('lokasi')->nullable(); // Alamat/Basecamp (Teks nama tempat)
    
    // ATRIBUT BARU: Untuk menyimpan URL Google Maps
    $table->text('link_maps')->nullable(); 
    
    $table->string('kontak')->nullable(); // Nomor WA atau Instagram
    $table->date('tanggal_event')->nullable(); // Hanya diisi jika kategori = event
    $table->string('gambar')->nullable(); // Path foto/poster
    $table->string('link_external')->nullable(); // Link YouTube/Spotify
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creative_district');
    }
};