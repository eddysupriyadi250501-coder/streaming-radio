<?php

namespace App\Filament\Resources\WisataResource\Pages;

use App\Filament\Resources\WisataResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWisata extends CreateRecord
{
    protected static string $resource = WisataResource::class;

     public function getTitle(): string
    {
        return 'Tambah Wisata';
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
