<?php

namespace App\Filament\Resources\UmkmResource\Pages;

use App\Filament\Resources\UmkmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUmkm extends EditRecord
{
    protected static string $resource = UmkmResource::class;

    public function getTitle(): string
    {
        return 'Ubah UMKM';
    }

    // Aksi tombol di bagian atas
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus'),
        ];
    }

    // Aksi tombol di bawah form
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan Perubahan'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }
}
