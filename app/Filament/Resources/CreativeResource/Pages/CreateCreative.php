<?php

namespace App\Filament\Resources\CreativeResource\Pages;

use App\Filament\Resources\CreativeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCreative extends CreateRecord
{
    protected static string $resource = CreativeResource::class;

    // Mengubah judul halaman
    public function getTitle(): string
    {
        return 'Tambah Creative District';
    }

    // Mengubah teks breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Tambah';
    }

    // Mengubah label tombol aksi di bawah form
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Simpan Data'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }
}