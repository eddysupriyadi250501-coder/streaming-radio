<?php

namespace App\Filament\Resources\SekolahKitaResource\Pages;

use App\Filament\Resources\SekolahKitaResource;
use App\Models\SekolahKita;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSekolahKita extends ListRecords
{
    protected static string $resource = SekolahKitaResource::class;

   public function getBreadcrumb(): string
    {
        return 'Daftar'; // Anda bisa menggunakan 'Daftar' atau 'List' sesuai keinginan
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Kegiatan Sekolah'),
        ];
    }
}
