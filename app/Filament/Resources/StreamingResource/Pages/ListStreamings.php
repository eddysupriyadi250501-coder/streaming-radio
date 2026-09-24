<?php

namespace App\Filament\Resources\StreamingResource\Pages;

use App\Filament\Resources\StreamingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStreamings extends ListRecords
{
    protected static string $resource = StreamingResource::class;

   public function getBreadcrumb(): string
    {
        return 'Daftar'; // Anda bisa menggunakan 'Daftar' atau 'List' sesuai keinginan
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Streaming'),
        ];
    }
}
