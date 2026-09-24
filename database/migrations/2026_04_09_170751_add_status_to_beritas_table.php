<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kita cek dulu apakah kolom 'status' sudah ada atau belum
        if (!Schema::hasColumn('berita', 'status')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->string('status')->default('draft');
            });
        }
    }

    public function down(): void
    {
        // Hanya hapus jika kolom memang ada
        if (Schema::hasColumn('berita', 'status')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};