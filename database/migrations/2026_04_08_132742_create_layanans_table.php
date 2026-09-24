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
        // Disesuaikan menjadi 'layanan' (tunggal) sesuai dengan yang ada di phpMyAdmin Anda
        Schema::create('layanan', function (Blueprint $table) {
    $table->id();
    $table->enum('kategori', ['call_center', 'lapor_mataram', 'ppid']);
    $table->string('judul')->nullable(); 
    $table->text('deskripsi')->nullable();
    $table->string('link_external')->nullable(); 
    $table->string('nomor_telepon')->nullable(); 
    $table->string('tipe_kontak')->nullable();  
    $table->string('email')->nullable();        
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};