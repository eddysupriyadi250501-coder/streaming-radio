<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SekolahKitaResource\Pages;
use App\Models\SekolahKita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;

class SekolahKitaResource extends Resource
{
    protected static ?string $model = SekolahKita::class;

    protected static ?string $pluralModelLabel = 'Sekolah Kita';
    protected static ?string $navigationLabel = 'Sekolah Kita';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kegiatan & Siswa')
                    ->description('Kelola data Ekstrakurikuler, Siswa Berprestasi, dan UKM.')
                    ->schema([
                        Forms\Components\Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'ekstrakurikuler' => 'Ekstrakurikuler',
                                'siswa' => 'Siswa Berprestasi',
                                'ukm' => 'UKM (Unit Kegiatan Mahasiswa)',
                            ])
                            ->required()
                            ->native(false)
                            ->live(),

                        Forms\Components\TextInput::make('judul')
                            ->label(fn (Get $get) => match ($get('kategori')) {
                                'siswa' => 'Nama Siswa',
                                default => 'Nama Kegiatan/Eskul',
                            })
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('asal_sekolah')
                            ->label('Asal Sekolah / Kampus')
                            ->required()
                            ->placeholder('Contoh: SMAN 1 Mataram'),

                        Forms\Components\TextInput::make('prestasi')
                            ->label('Prestasi yang Diraih')
                            ->placeholder('Contoh: Juara satu umum')
                            ->visible(fn (Get $get) => $get('kategori') === 'siswa')
                            ->required(fn (Get $get) => $get('kategori') === 'siswa'),

                        Forms\Components\RichEditor::make('deskripsi')
                            ->label('Keterangan / Profil Singkat')
                            ->columnSpanFull()
                            ->required(),

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Foto Kegiatan / Siswa')
                            ->image()
                            ->directory('school-activities')
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

                Tables\Columns\TextColumn::make('judul')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                        'siswa' => 'Siswa Berprestasi',
                        'ukm' => 'UKM',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'ekstrakurikuler' => 'info',
                        'siswa' => 'warning',
                        'ukm' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->label('Sekolah/Kampus')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl Input')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                        'siswa' => 'Siswa Berprestasi',
                        'ukm' => 'UKM',
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
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSekolahKita::route('/'),
            'create' => Pages\CreateSekolahKita::route('/create'),
            'edit' => Pages\EditSekolahKita::route('/{record}/edit'),
        ];
    }
}