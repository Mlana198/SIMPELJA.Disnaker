<?php

namespace App\Filament\Kabid\Resources\LaporanPelatihans\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class LaporanPelatihansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->searchable(),

                TextColumn::make('tanggal_mulai')
                    ->label('Mulai')
                    ->date('d M Y'),

                IconColumn::make('status_laporan')
                    ->label('Status Persetujuan')
                    ->options([
                        'heroicon-o-paper-airplane' => fn($state) => $state === 'diajukan',
                        'heroicon-o-check-circle' => fn($state) => $state === 'disetujui',
                        'heroicon-o-arrow-path' => fn($state) => $state === 'direvisi',
                        'heroicon-o-x-circle' => fn($state) => $state === 'ditolak',
                    ])
                    ->colors([
                        'info' => fn($state) => $state === 'diajukan',
                        'success' => fn($state) => $state === 'disetujui',
                        'warning' => fn($state) => $state === 'direvisi',
                        'danger' => fn($state) => $state === 'ditolak',
                    ])
                    ->alignCenter(),
            ])
            ->filters([])
            ->actions([
                // Validasi Per Baris Laporan
                Action::make('validasiLaporan')
                    ->label('Validasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('warning')
                    ->visible(fn($record) => $record && $record->status_laporan === 'diajukan')
                    ->form([
                        \Filament\Forms\Components\Select::make('status_laporan')
                            ->label('Keputusan Validasi Kabid')
                            ->options([
                                'disetujui' => 'Setujui Laporan',
                                'direvisi' => 'Kembalikan (Butuh Revisi)',
                                'ditolak' => 'Tolak Laporan',
                            ])
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('catatan_revisi')
                            ->label('Catatan Keterangan Tambahan')
                            ->rows(2),
                    ])

                    ->action(function ($record, array $data): void {

                        $record->update([
                            'status_laporan' => $data['status_laporan'],
                        ]);

                        Notification::make()
                            ->title('Validasi Berhasil Disimpan')
                            ->success()
                            ->send();
                    })
                    ->modalHeading('Konfirmasi Validasi Laporan'),
            ])
            ->bulkActions([
                // Validasi Massal Laporan Terpilih
                BulkAction::make('setujuiMassal')
                    ->label('Setujui Laporan Terpilih')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (Collection $records): void {
                        $records->each(function ($record) {
                            // Hanya proses data yang memang dikirim/diajukan
                            if ($record->status_laporan === 'diajukan') {
                                $record->update(['status_laporan' => 'disetujui']);
                            }
                        });

                        Notification::make()
                            ->title('Laporan Terpilih Berhasil Disetujui')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Persetujuan Massal Laporan')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui seluruh laporan pelatihan yang dipilih?'),
            ]);
    }
}
