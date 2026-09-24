<?php

namespace App\Filament\Resources\CreativeResource\Pages;

use App\Filament\Resources\CreativeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCreative extends EditRecord
{
    protected static string $resource = CreativeResource::class;

    // Judul Halaman
    public function getTitle(): string
    {
        return 'Ubah Data Creative District';
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