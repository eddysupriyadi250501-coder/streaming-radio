<?php

namespace App\Filament\Resources\StreamingResource\Pages;

use App\Filament\Resources\StreamingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStreaming extends EditRecord
{
    protected static string $resource = StreamingResource::class;

   
    public function getTitle(): string
    {
        return 'Ubah Streaming';
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
