<?php

namespace App\Filament\Instruktur\Resources\Materis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class MaterisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->sortable(),
                TextColumn::make('judul_materi')
                    ->label('Judul Materi')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Unggah')
                    ->date()
                    ->sortable(),
            ])

            ->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                $query->whereHas('pelatihan.jadwalInterviews', function ($q) {
                    $q->where('interviewer_user_id', Auth::id());
                });
            })
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
