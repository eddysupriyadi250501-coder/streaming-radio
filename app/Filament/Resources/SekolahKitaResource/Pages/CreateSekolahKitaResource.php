<?php

namespace App\Filament\Resources\SekolahKitaResource\Pages;

use App\Filament\Resources\SekolahKitaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSekolahKita extends CreateRecord
{
    protected static string $resource = SekolahKitaResource::class;

    public function getTitle(): string
    {
        return 'Tambah Kegiatan Sekolah';
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
