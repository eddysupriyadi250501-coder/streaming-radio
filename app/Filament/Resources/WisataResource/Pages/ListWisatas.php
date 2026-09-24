<?php

namespace App\Filament\Resources\WisataResource\Pages;

use App\Filament\Resources\WisataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWisatas extends ListRecords
{
    protected static string $resource = WisataResource::class;

   public function getBreadcrumb(): string
    {
        return 'Daftar'; // Anda bisa menggunakan 'Daftar' atau 'List' sesuai keinginan
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Wisata'),
        ];
    }
}
