<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->modalHeading('Hapus Pengguna')
                ->modalDescription('Apakah Anda yakin ingin menghapus pengguna ini?')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Batal')
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Berhasil')
                        ->body('Data pengguna berhasil dihapus.')
                ),
        ];
    }

    // Mengubah teks tombol Simpan Perubahan
    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan Perubahan');
    }

    // Mengubah teks tombol Batal
    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    // Notifikasi Pop-up saat Berhasil Diperbarui
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data pengguna berhasil diperbarui.');
    }
}