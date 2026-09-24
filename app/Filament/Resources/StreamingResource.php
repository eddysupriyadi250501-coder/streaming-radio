<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StreamingResource\Pages;
use App\Models\Streaming;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class StreamingResource extends Resource
{
    protected static ?string $model = Streaming::class;
    protected static ?string $pluralModelLabel = 'Streaming';
    protected static ?string $navigationLabel = 'Streaming';
    protected static ?string $navigationIcon = 'heroicon-o-play';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Streaming')
                    ->description('Lengkapi detail siaran streaming di bawah ini.')
                    ->schema([
                        // Select harus di atas agar logika hidden bekerja dengan benar
                        Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'live_radio' => 'Live Radio',
                                'live_youtube' => 'Live YouTube',
                                'podcast' => 'Podcast',
                            ])
                            ->required()
                            ->native(false)
                            ->live(), // Penting untuk update form secara real-time

                        TextInput::make('judul')
                            ->label('Judul Siaran')
                            ->placeholder('Contoh: Mataram Menyapa Pagi')
                            ->required()
                            ->maxLength(255)
                            ->hidden(fn (Forms\Get $get) => $get('kategori') === 'live_radio'),

                        TextInput::make('link_eksternal') 
                            ->label('URL Link Streaming')
                            ->nullable()
                            ->placeholder('Kosongkan jika tidak ada link')
                            ->url(),
                       

                        Textarea::make('deskripsi')
                            ->label('Deskripsi Singkat')
                            ->placeholder('Jelaskan isi siaran ini...')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull()
                            ->hidden(fn (Forms\Get $get) => $get('kategori') === 'live_radio'),

                        FileUpload::make('thumbnail')
                            ->label('Gambar Preview / Thumbnail')
                            ->image()
                            ->directory('streamings')
                            ->required()
                            ->columnSpanFull()
                            ->hidden(fn (Forms\Get $get) => $get('kategori') === 'live_radio'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->circular(),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->default('—'),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'live_radio' => 'Live Radio',
                        'live_youtube' => 'Live YouTube',
                        'podcast' => 'Podcast',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'live_radio' => 'success',
                        'live_youtube' => 'danger',
                        'podcast' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                
                Tables\Actions\Action::make('visit')
                    ->label('Buka Link')
                    ->icon('heroicon-m-cursor-arrow-rays')
                    ->color('success')
                    ->url(fn ($record) => $record->link_eksternal)
                    ->openUrlInNewTab(),

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data Streaming')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data siaran ini?')
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
            'index' => Pages\ListStreamings::route('/'),
            'create' => Pages\CreateStreaming::route('/create'),
            'edit' => Pages\EditStreaming::route('/{record}/edit'),
        ];
    }
}