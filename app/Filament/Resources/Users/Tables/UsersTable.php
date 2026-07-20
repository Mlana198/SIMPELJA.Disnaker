<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_identitas')
                    ->label('No. Identitas')
                    ->searchable()
                    ->sortable(),

                // Menampilkan nama lengkap dari relasi profil di tabel list data user
                TextColumn::make('profil.nama_lengkap')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->default('- Belum Isi Profil -'),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('role')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'kabid' => 'success',
                        'subkoordinator' => 'warning',
                        'instruktur' => 'info',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
