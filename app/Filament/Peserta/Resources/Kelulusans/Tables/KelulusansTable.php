<?php

namespace App\Filament\Peserta\Resources\Kelulusans\Tables;

use App\Models\Sertifikat;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KelulusansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->searchable(),

                TextColumn::make('status_kelulusan')
                    ->label('Status Keputusan')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'lulus',
                        'danger' => 'tidak_lulus',
                    ])
                    ->icons([
                        'heroicon-m-clock' => 'pending',
                        'heroicon-m-check-circle' => 'lulus',
                        'heroicon-m-x-circle' => 'tidak_lulus',
                    ]),
            ])
            ->recordActions([
                Action::make('downloadSertifikat')
                    ->label('Unduh Sertifikat')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->color('success')
                    ->url(fn($record) => route('sertifikat.download', $record->id)) // Kirim pendaftaran_id
                    ->openUrlInNewTab()
                    ->visible(function ($record) {
                        return $record->status_kelulusan === 'lulus' &&
                            Sertifikat::where('pendaftaran_id', $record->id)->exists(); // Cek ke pendaftaran_id
                    }),
            ]);
    }
}
