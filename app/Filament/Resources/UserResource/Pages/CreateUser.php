<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Actions\Action;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // Mengubah judul halaman dari "Create Pengguna" menjadi "Tambah Pengguna"
    public function getTitle(): string
    {
        return 'Tambah Pengguna';
    }

    // Mengubah teks tombol Simpan Utama
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan');
    }

    // Mengubah teks tombol Simpan & Buat Lagi
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Simpan & Buat Lagi');
    }

    // Mengubah teks tombol Batal
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    // Notifikasi Pop-up Sukses
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Pengguna baru berhasil ditambahkan.');
    }
}