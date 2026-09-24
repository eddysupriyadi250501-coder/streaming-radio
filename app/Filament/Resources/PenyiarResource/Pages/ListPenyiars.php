<?php

namespace App\Filament\Resources\PenyiarResource\Pages;

use App\Filament\Resources\PenyiarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyiars extends ListRecords
{
    protected static string $resource = PenyiarResource::class;
 public function getBreadcrumb(): string
    {
        return 'Daftar'; // Anda bisa menggunakan 'Daftar' atau 'List' sesuai keinginan
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Penyiar'),
        ];
    }
}
