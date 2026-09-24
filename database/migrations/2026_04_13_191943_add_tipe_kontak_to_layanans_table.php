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
        // Diubah dari 'layanans' menjadi 'layanan' (tunggal)
        Schema::table('layanan', function (Blueprint $table) {
            // Mengubah atau memastikan kolom tipe_kontak menggunakan enum
            $table->enum('tipe_kontak', ['wa', 'tel', 'both'])->default('wa')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            // Kembalikan ke struktur semula jika di-rollback (opsional)
            // Anda bisa mengosongkannya atau membiarkannya seperti ini
        });
    }
};