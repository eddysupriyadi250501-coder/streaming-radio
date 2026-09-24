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
        Schema::create('penyiar', function (Blueprint $table) {
            $table->id();
            // Ubah 'nama_penyiar' menjadi 'nama' agar sesuai dengan Controller
            $table->string('nama'); 
            $table->string('foto')->nullable();
            // Tambahkan kolom yang kurang agar tidak error
            $table->string('instagram')->nullable();
            $table->text('bio')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyiar');
    }
};