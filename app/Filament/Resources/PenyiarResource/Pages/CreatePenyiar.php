<?php

namespace App\Filament\Resources\PenyiarResource\Pages;

use App\Filament\Resources\PenyiarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenyiar extends CreateRecord
{
    protected static string $resource = PenyiarResource::class;
      public function getTitle(): string
    {
        return 'Tambah Penyiar';
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
