<?php

namespace App\Filament\Peserta\Resources\Pendaftarans\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PendaftaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('buktiPendaftaran.nomor_registrasi')
                    ->label('Nomor Pendaftaran')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Nama Pelatihan'),
                TextColumn::make('status_seleksi_administrasi')
                    ->label('Status Pendaftaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'lolos' => 'success',
                        'tidak_lolos' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('downloadBukti')
                    ->label('Download Bukti')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->button()
                    ->visible(fn($record) => $record->status_seleksi_administrasi === 'lolos')
                    ->url(fn($record) => route('pendaftaran.bukti.download', $record->id))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
