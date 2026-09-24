<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    // Mengatur posisi menu di sidebar agar berada tepat di bawah Dashboard
    protected static ?int $navigationSort = 1;
    
    // Label menu di sidebar
    protected static ?string $navigationLabel = 'Kelola Data Pengguna';
    protected static ?string $pluralModelLabel = 'Pengguna';
    protected static ?string $modelLabel = 'Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Lengkap')
                    ->placeholder('Masukkan nama lengkap'),
                
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Alamat Email')
                    ->placeholder('contoh@email.com'),
                
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255)
                    ->label('Kata Sandi')
                    ->placeholder('Masukkan kata sandi baru'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->label('Dibuat Pada'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Ubah')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil!')
                            ->body('Data pengguna berhasil diperbarui.')
                    ),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    // --- TAMBAHAN UNTUK POP-UP BAHASA INDONESIA ---
                    ->modalHeading('Hapus Pengguna')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data pengguna ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    // ----------------------------------------------
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil!')
                            ->body('Data pengguna berhasil dihapus.')
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        // --- TAMBAHAN UNTUK POP-UP HAPUS BANYAK BAHASA INDONESIA ---
                        ->modalHeading('Hapus Pengguna Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus semua data pengguna yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal')
                        // -----------------------------------------------------------
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Berhasil!')
                                ->body('Data pengguna terpilih berhasil dihapus.')
                        ),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}