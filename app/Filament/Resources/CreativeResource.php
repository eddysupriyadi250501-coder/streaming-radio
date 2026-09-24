<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreativeResource\Pages;
use App\Models\CreativeDistrict;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;

class CreativeResource extends Resource
{
    protected static ?string $model = CreativeDistrict::class;

    protected static ?string $pluralModelLabel = 'Creative District';    
    protected static ?string $navigationLabel = 'Creative District';
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama')
                    ->description('Lengkapi data sesuai kategori yang dipilih')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama / Judul'),

                        Forms\Components\Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'komunitas' => 'Komunitas',
                                'musisi' => 'Musisi/Band',
                                'seniman' => 'Seniman',
                                'event' => 'Event',
                                'film' => 'Resensi Film Indie',
                            ])
                            ->required()
                            ->native(false)
                            ->live(), 

                        Forms\Components\Textarea::make('deskripsi')
                            ->required()
                            ->columnSpanFull()
                            ->label(fn (Get $get) => $get('kategori') === 'film' ? 'Resensi Film' : 'Deskripsi / Profil'),

                        Forms\Components\TextInput::make('lokasi')
                            ->label('Lokasi')
                            ->hidden(fn (Get $get) => $get('kategori') === 'film') 
                            ->placeholder('Alamat atau Lokasi Basecamp'),

                        Forms\Components\TextInput::make('link_maps')
                            ->label('Link Google Maps')
                            ->placeholder('https://goo.gl/maps/...')
                            ->url()
                            ->hidden(fn (Get $get) => $get('kategori') === 'film')
                            ->columnSpanFull(),

                        Forms\Components\DatePicker::make('tanggal_event')
                            ->label('Tanggal Event')
                            ->visible(fn (Get $get) => $get('kategori') === 'event') 
                            ->required(fn (Get $get) => $get('kategori') === 'event'),

                        Forms\Components\TextInput::make('kontak')
                            ->label('WhatsApp / Instagram')
                            ->hidden(fn (Get $get) => $get('kategori') === 'film'),

                        Forms\Components\TextInput::make('link_external')
                            ->label(fn (Get $get) => $get('kategori') === 'film' ? 'Link Trailer' : 'Link Social Media')
                            ->url()
                            ->placeholder('https://...'),

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Gambar')
                            ->image()
                            ->directory('creative-districts')
                            ->placeholder('Klik untuk mengunggah berkas di sini')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge() 
                    ->color(fn (string $state): string => match ($state) {
                        'event' => 'warning',
                        'film' => 'danger',
                        'komunitas' => 'success',
                        'musisi' => 'info',
                        'seniman' => 'gray',
                        default => 'primary',
                    })
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('tanggal_event')
                    ->label('Tanggal Event')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'komunitas' => 'Komunitas',
                        'musisi' => 'Musisi/Band',
                        'seniman' => 'Seniman',
                        'event' => 'Event',
                        'film' => 'Resensi Film Indie',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->modalHeading('Hapus Data Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data-data terpilih ini? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCreatives::route('/'),
            'create' => Pages\CreateCreative::route('/create'),
            'edit' => Pages\EditCreative::route('/{record}/edit'),
        ];
    }
}