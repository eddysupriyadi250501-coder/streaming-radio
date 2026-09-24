<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Get;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    protected static ?string $pluralModelLabel = 'Layanan Publik';
    protected static ?string $navigationLabel = 'Layanan Publik';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Layanan')
                    ->description('Pilih kategori layanan untuk melengkapi data yang diperlukan.')
                    ->schema([
                        Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'call_center' => 'Call Center',
                                'lapor_mataram' => 'Lapor Mataram',
                                'ppid' => 'PPID',
                            ])
                            ->required()
                            ->native(false)
                            ->live(),

                        TextInput::make('judul')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255),

                        Group::make([
                            TextInput::make('nomor_telepon')
                                ->label('Nomor Call Center / WA')
                                ->tel()
                                ->placeholder('Contoh: 08123456789')
                                ->required(),
                            
                            Select::make('tipe_kontak')
                                ->label('Tampilkan Sebagai')
                                ->options([
                                    'tel' => 'Telepon Biasa (Ikon Hitam)',
                                    'wa' => 'WhatsApp (Ikon Hijau)',
                                    'both' => 'Keduanya (WA & Telepon)',
                                ])
                                ->default('tel')
                                ->required()
                                ->native(false),
                        ])
                        ->visible(fn (Get $get) => $get('kategori') === 'call_center')
                        ->columns(2),

                        TextInput::make('link_external')
                            ->label('Link Portal / Website')
                            ->url()
                            ->placeholder('https://...')
                            ->visible(fn (Get $get) => in_array($get('kategori'), ['ppid', 'lapor_mataram']))
                            ->required(fn (Get $get) => in_array($get('kategori'), ['ppid', 'lapor_mataram'])),

                        TextInput::make('email')
                            ->label('Email Resmi / Notifikasi')
                            ->email()
                            ->placeholder('Contoh: info@suarakotamataram.com')
                            ->maxLength(255)
                            ->visible(fn (Get $get) => $get('kategori') === 'call_center')
                            ->required(fn (Get $get) => $get('kategori') === 'call_center'),

                        RichEditor::make('deskripsi')
                            ->label('Deskripsi Layanan')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'call_center' => 'info',
                        'lapor_mataram' => 'warning',
                        'ppid' => 'success',
                        default => 'primary',
                    }),

                Tables\Columns\TextColumn::make('nomor_telepon')
                    ->label('Kontak')
                    ->description(fn (Layanan $record): string => 
                        $record->kategori === 'call_center' 
                        ? ($record->tipe_kontak === 'wa' ? 'WhatsApp' : 'Telepon') 
                        : 'Kontak Umum'
                    )
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email Tujuan')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'call_center' => 'Call Center',
                        'lapor_mataram' => 'Lapor Mataram',
                        'ppid' => 'PPID',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data Layanan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus layanan ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->modalHeading('Hapus Data Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data layanan terpilih ini?')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}