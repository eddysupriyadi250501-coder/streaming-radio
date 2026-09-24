<?php

namespace App\Filament\Resources\LayananResource\Pages;

use App\Filament\Resources\LayananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayanans extends ListRecords
{
    protected static string $resource = LayananResource::class;

    public function getTitle(): string
    {
        return 'Daftar Layanan Publik';
    }

    public function getBreadcrumb(): string
    {
        return 'Daftar';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Layanan Publik'),
        ];
    }
}