<?php

namespace App\Filament\Resources\LayananResource\Pages;

use App\Filament\Resources\LayananResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLayanan extends CreateRecord
{
    protected static string $resource = LayananResource::class;

    public function getTitle(): string
    {
        return 'Tambah Layanan Publik';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Simpan Data'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }
}