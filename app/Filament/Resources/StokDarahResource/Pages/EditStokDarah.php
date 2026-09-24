<?php

namespace App\Filament\Resources\StokDarahResource\Pages;

use App\Filament\Resources\StokDarahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStokDarah extends EditRecord
{
    protected static string $resource = StokDarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
