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
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->string('kategori'); // Saya tambahkan ini karena Anda memerlukannya
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('harga_tiket')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('gambar')->nullable();
            
            // PERBAIKAN: Gunakan text() agar tidak error "Data too long"
            $table->text('maps_url')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};