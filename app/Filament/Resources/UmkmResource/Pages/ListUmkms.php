<?php

namespace App\Filament\Resources\UmkmResource\Pages;

use App\Filament\Resources\UmkmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUmkms extends ListRecords
{
    protected static string $resource = UmkmResource::class;

   public function getBreadcrumb(): string
    {
        return 'Daftar'; // Anda bisa menggunakan 'Daftar' atau 'List' sesuai keinginan
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah UMKM'),
        ];
    }
}
