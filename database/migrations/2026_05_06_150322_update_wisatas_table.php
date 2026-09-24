<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menggunakan Schema::table (artinya mengubah tabel yang sudah ada, bukan membuat baru)
        Schema::table('wisata', function (Blueprint $table) {
            
            // Hanya tambah 'kategori' jika belum ada di tabel wisata
            if (!Schema::hasColumn('wisata', 'kategori')) {
                $table->string('kategori')->after('nama_wisata');
            }

            // Hanya tambah 'harga_tiket' jika belum ada
            if (!Schema::hasColumn('wisata', 'harga_tiket')) {
                $table->string('harga_tiket')->nullable()->after('kategori');
            }

            // Hanya tambah 'jam_operasional' jika belum ada
            if (!Schema::hasColumn('wisata', 'jam_operasional')) {
                $table->string('jam_operasional')->nullable()->after('harga_tiket');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            if (Schema::hasColumn('wisata', 'kategori')) {
                $table->dropColumn('kategori');
            }
            if (Schema::hasColumn('wisata', 'harga_tiket')) {
                $table->dropColumn('harga_tiket');
            }
            if (Schema::hasColumn('wisata', 'jam_operasional')) {
                $table->dropColumn('jam_operasional');
            }
        });
    }
};