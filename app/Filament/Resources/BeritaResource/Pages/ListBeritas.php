<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBeritas extends ListRecords
{
    protected static string $resource = BeritaResource::class;

     public function getBreadcrumb(): string
    {
        return 'Daftar'; // Anda bisa menggunakan 'Daftar' atau 'List' sesuai keinginan
    }

    // Tambahkan fungsi ini untuk mengubah teks tombol "New Berita"
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Berita'), // <--- INI YANG MENGUBAH TEKS TOMBOLNYA
        ];
    }
}