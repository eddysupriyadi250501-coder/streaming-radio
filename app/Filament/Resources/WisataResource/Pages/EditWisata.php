<?php

namespace App\Filament\Resources\WisataResource\Pages;

use App\Filament\Resources\WisataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWisata extends EditRecord
{
    protected static string $resource = WisataResource::class;

      public function getTitle(): string
    {
        return 'Ubah Wisata';
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
