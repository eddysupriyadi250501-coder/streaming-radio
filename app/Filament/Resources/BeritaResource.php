<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $pluralModelLabel = 'Berita';    
    protected static ?string $navigationLabel = 'Manajemen Berita';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Berita')
                    ->description('Lengkapi detail berita di bawah ini.')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, $set) => 
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(Berita::class, 'slug', ignoreRecord: true),

                        Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'Mataram Dalam Berita' => 'Mataram Dalam Berita',
                                'Berita NTB' => 'Berita NTB',
                                'Berita Internasional' => 'Berita Internasional',
                            ])
                            ->required()
                            ->native(false),

                        FileUpload::make('gambar')
                            ->label('Gambar Berita')
                            ->image()
                            ->directory('berita')
                            ->imageEditor()
                            ->placeholder('Klik untuk mengunggah berkas di sini'),
                        
                        TextInput::make('penulis')
                            ->label('Penulis')
                            ->maxLength(100),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Dipublikasi',
                            ])
                            ->default('published')
                            ->required(),

                        RichEditor::make('isi_berita')
                            ->label('Isi Berita')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular(),
                
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal Posting')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasi',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data Berita')
                    ->modalDescription('Apakah Anda yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->modalHeading('Hapus Berita Terpilih')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}