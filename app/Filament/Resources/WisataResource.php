<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WisataResource\Pages;
use App\Models\Wisata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;

class WisataResource extends Resource
{
    protected static ?string $model = Wisata::class;

    protected static ?string $pluralModelLabel = 'Wisata';
    protected static ?string $navigationLabel = 'Objek Wisata';
    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama Wisata')
                    ->description('Lengkapi data destinasi atau tempat tongkrongan di Kota Mataram.')
                    ->schema([
                        Forms\Components\TextInput::make('nama_wisata')
                            ->label('Nama Lokasi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Taman Udayana'),

                        Select::make('kategori')
                            ->label('Kategori Tempat')
                            ->options([
                                'wisata' => 'Wisata',
                                'tongkrongan' => 'Tongkrongan Asyik',
                            ])
                            ->required()
                            ->native(false)
                            ->live(),

                        Forms\Components\TextInput::make('lokasi')
                            ->label('Lokasi')
                            ->required()
                            ->placeholder('Contoh: Ampenan, Mataram'),

                        Forms\Components\TextInput::make('harga_tiket')
                            ->label('Harga Tiket Masuk')
                            ->placeholder('Contoh: Rp 10.000 / Gratis')
                            ->visible(fn (Get $get) => $get('kategori') === 'wisata'),

                        Forms\Components\TextInput::make('jam_operasional')
                            ->label('Jam Operasional')
                            ->placeholder('Contoh: 08:00 - 17:00 WITA')
                            ->visible(fn (Get $get) => $get('kategori') === 'wisata'),

                        Forms\Components\TextInput::make('maps_url')
                            ->label('Link Google Maps')
                            ->url()
                            ->placeholder('https://goo.gl/maps/...'),

                        Forms\Components\RichEditor::make('deskripsi')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Foto Lokasi')
                            ->image()
                            ->directory('wisata-photos')
                            ->placeholder('Klik untuk mengunggah foto')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama_wisata')
                    ->label('Nama Tempat')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'wisata' => 'Wisata',
                        'tongkrongan' => 'Tongkrongan Asyik',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'wisata' => 'success',
                        'tongkrongan' => 'warning',
                        default => 'primary',
                    }),

                Tables\Columns\TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga_tiket')
                    ->label('Tiket')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'wisata' => 'Wisata',
                        'tongkrongan' => 'Tongkrongan Asyik',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data Wisata')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data lokasi ini?')
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
            'index' => Pages\ListWisatas::route('/'),
            'create' => Pages\CreateWisata::route('/create'),
            'edit' => Pages\EditWisata::route('/{record}/edit'),
        ];
    }
}