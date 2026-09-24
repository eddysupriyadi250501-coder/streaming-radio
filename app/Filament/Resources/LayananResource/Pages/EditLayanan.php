<?php

namespace App\Filament\Resources\LayananResource\Pages;

use App\Filament\Resources\LayananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayanan extends EditRecord
{
    protected static string $resource = LayananResource::class;

    public function getTitle(): string
    {
        return 'Ubah Data Layanan Publik';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan Perubahan'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }
}