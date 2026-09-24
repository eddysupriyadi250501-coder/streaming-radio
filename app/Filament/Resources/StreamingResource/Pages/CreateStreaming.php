<?php

namespace App\Filament\Resources\StreamingResource\Pages;

use App\Filament\Resources\StreamingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStreaming extends CreateRecord
{
    protected static string $resource = StreamingResource::class;

      public function getTitle(): string
    {
        return 'Tambah Streaming';
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
