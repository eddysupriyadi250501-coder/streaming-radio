<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification; // <--- Penting untuk notifikasi

class EditBerita extends EditRecord
{
    protected static string $resource = BeritaResource::class;

    // Mengubah judul halaman
    public function getTitle(): string
    {
        return 'Ubah Berita';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus'), // Mengubah label jadi Hapus
        ];
    }

    // Mengubah tombol simpan di bawah form
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan Perubahan'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }

    // Notifikasi sukses setelah berhasil update
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Tersimpan!')
            ->body('Data berita telah berhasil diperbarui.');
    }
}