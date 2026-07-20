<?php

namespace App\Filament\Peserta\Resources\HasilPelatihans\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HasilPelatihansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->searchable(),

                TextColumn::make('nilai_teori')
                    ->label('Nilai Teori')
                    ->alignCenter(),

                TextColumn::make('nilai_praktek')
                    ->label('Nilai Praktek')
                    ->alignCenter(),

                TextColumn::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->badge()
                    ->color('primary')
                    ->getStateUsing(function ($record) {
                        if (blank($record->nilai_akhir)) {
                            return ((float)$record->nilai_teori + (float)$record->nilai_praktek) / 2;
                        }
                        return $record->nilai_akhir;
                    }),

                TextColumn::make('catatan_instruktur')
                    ->label('Catatan Instruktur')
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //    
            ])
            ->toolbarActions([
                // 
            ]);
    }
}
