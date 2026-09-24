<?php

namespace App\Filament\Resources\PenyiarResource\Pages;

use App\Filament\Resources\PenyiarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyiar extends EditRecord
{
    protected static string $resource = PenyiarResource::class;

   public function getTitle(): string
    {
        return 'Ubah Data Penyiar';
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
