<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenyiarResource\Pages;
use App\Models\Penyiar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PenyiarResource extends Resource
{
    protected static ?string $model = Penyiar::class;

    protected static ?string $pluralModelLabel = 'Penyiar';
    protected static ?string $navigationLabel = 'Daftar Penyiar';
    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profil Penyiar')
                    ->description('Masukkan data diri penyiar sesuai dengan identitas radio.')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Penyiar')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: JACK'),

                        FileUpload::make('foto')
                            ->label('Foto Penyiar')
                            ->image()
                            ->disk('public')
                            ->directory('penyiar')
                            ->visibility('public')
                            ->required()
                            ->imageEditor()
                            ->placeholder('Klik untuk mengunggah foto')
                            ->helperText('Gunakan foto dengan background kuning agar seragam.'),

                        TextInput::make('instagram')
                            ->label('Username Instagram')
                            ->prefix('https://instagram.com/')
                            ->placeholder('username_penyiar')
                            ->maxLength(255),

                        Textarea::make('bio')
                            ->label('Biografi')
                            ->required()
                            ->rows(3)
                            ->placeholder('Contoh: Ardan Announcer'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->square()
                    ->size(50),
                
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('instagram')
                    ->label('Instagram')
                    ->icon('heroicon-m-camera')
                    ->copyable()
                    ->copyMessage('Username disalin'),

                TextColumn::make('bio')
                    ->label('Biografi')
                    ->limit(50)
                    ->tooltip(fn (Penyiar $record): string => $record->bio),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data Penyiar')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data penyiar ini?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->modalHeading('Hapus Data Terpilih')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenyiars::route('/'),
            'create' => Pages\CreatePenyiar::route('/create'),
            'edit' => Pages\EditPenyiar::route('/{record}/edit'),
        ];
    }
}