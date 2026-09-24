<?php

namespace App\Filament\Resources\SekolahKitaResource\Pages;

use App\Filament\Resources\SekolahKitaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSekolahKita extends EditRecord
{
    protected static string $resource = SekolahKitaResource::class;

    public function getTitle(): string
    {
        return 'Ubah Kegiatan Sekolah';
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
