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
        // 1. Ganti nama tabel menjadi 'streaming' (Tunggal)
        Schema::create('streaming', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); 
            $table->enum('kategori', ['live_radio', 'live_youtube', 'podcast']);
            
            // 2. Ganti 'url_stream' menjadi 'link_eksternal' agar cocok dengan LandingController
            $table->string('link_eksternal')->nullable(); 
            
            $table->text('deskripsi')->nullable();
            $table->string('thumbnail')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 3. Ganti juga di bagian drop menjadi 'streaming'
        Schema::dropIfExists('streaming');
    }
};