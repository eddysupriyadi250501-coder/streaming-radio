<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmkmResource\Pages;
use App\Models\Umkm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class UmkmResource extends Resource
{
    protected static ?string $model = Umkm::class;

    protected static ?string $pluralModelLabel = 'UMKM';
    protected static ?string $navigationLabel = 'Data UMKM';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Usaha')
                    ->description('Masukkan informasi lengkap mengenai UMKM')
                    ->schema([
                        Forms\Components\TextInput::make('nama_usaha')
                            ->label('Nama Toko / Usaha')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Kerupuk Kulit Khas Mataram'),

                        Forms\Components\Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'kriya' => 'Kriya (Kerajinan)',
                                'fashion' => 'Fashion',
                                'kuliner' => 'Kuliner',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\TextInput::make('pemilik')
                            ->label('Nama Pemilik UMKM')
                            ->placeholder('Masukkan nama pemilik'),

                        Forms\Components\TextInput::make('no_hp')
                            ->label('Nomor WhatsApp')
                            ->tel()
                            ->placeholder('081234567890'),

                        Forms\Components\TextInput::make('instagram')
                            ->label('Username Instagram')
                            ->placeholder('@toko_umkm'),

                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        // PENAMBAHAN FIELD MAPS URL DI SINI
                        Forms\Components\TextInput::make('maps_url')
                            ->label('Link Google Maps')
                            ->url() 
                            ->placeholder('https://maps.app.goo.gl/xxx')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('deskripsi')
                            ->label('Deskripsi Produk/Usaha')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Foto Produk / Toko')
                            ->image()
                            ->directory('umkm-photos')
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

                Tables\Columns\TextColumn::make('nama_usaha')
                    ->label('Nama Usaha')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'kriya' => 'warning',
                        'fashion' => 'success',
                        'kuliner' => 'danger',
                        default => 'primary',
                    }),

                Tables\Columns\TextColumn::make('pemilik')
                    ->label('Pemilik')
                    ->searchable(),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Kontak WA')
                    ->icon('heroicon-m-phone'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'kriya' => 'Kriya',
                        'fashion' => 'Fashion',
                        'kuliner' => 'Kuliner',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data UMKM')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data UMKM ini? Tindakan ini tidak dapat dibatalkan.')
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
            'index' => Pages\ListUmkms::route('/'),
            'create' => Pages\CreateUmkm::route('/create'),
            'edit' => Pages\EditUmkm::route('/{record}/edit'),
        ];
    }
}