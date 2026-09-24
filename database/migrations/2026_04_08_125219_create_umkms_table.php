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

    Schema::create('umkm', function (Blueprint $table) {
        $table->id();
        $table->string('nama_usaha');
        $table->enum('kategori', ['kriya', 'fashion', 'kuliner']);
        $table->string('pemilik')->nullable();
        $table->text('alamat');
        $table->string('no_hp')->nullable(); // Untuk WhatsApp
        $table->string('instagram')->nullable();
        $table->string('gambar')->nullable(); // Foto produk atau toko
        $table->text('deskripsi')->nullable();
        $table->string('maps_url')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
