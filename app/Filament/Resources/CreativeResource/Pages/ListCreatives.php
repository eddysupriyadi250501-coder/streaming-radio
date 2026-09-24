<?php

namespace App\Filament\Resources\CreativeResource\Pages;

use App\Filament\Resources\CreativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCreatives extends ListRecords
{
    protected static string $resource = CreativeResource::class;

    // Tambahkan fungsi ini untuk mengubah breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Daftar'; // Anda bisa menggunakan 'Daftar' atau 'List' sesuai keinginan
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Creative District'),
        ];
    }
}