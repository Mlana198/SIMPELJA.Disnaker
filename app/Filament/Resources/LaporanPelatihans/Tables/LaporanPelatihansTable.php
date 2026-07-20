<?php

namespace App\Filament\Resources\LaporanPelatihans\Tables;

use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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

                TextColumn::make('pendaftarans_count')
                    ->label('Total Peserta')
                    ->counts('pendaftarans')
                    ->alignCenter(),

                IconColumn::make('status_laporan')
                    ->label('Status Pengajuan')
                    ->options([
                        'heroicon-o-document-text' => fn($state) => blank($state) || $state === 'draft',
                        'heroicon-o-paper-airplane' => fn($state) => $state === 'diajukan',
                        'heroicon-o-check-circle' => fn($state) => $state === 'disetujui',
                        'heroicon-o-arrow-path' => fn($state) => $state === 'direvisi',
                        'heroicon-o-x-circle' => fn($state) => $state === 'ditolak',
                    ])
                    ->colors([
                        'secondary' => fn($state) => blank($state) || $state === 'draft',
                        'info' => fn($state) => $state === 'diajukan',
                        'success' => fn($state) => $state === 'disetujui',
                        'warning' => fn($state) => $state === 'direvisi',
                        'danger' => fn($state) => $state === 'ditolak',
                    ])
                    ->alignCenter(),
            ])
            ->filters([])
            ->actions([
                // Tombol Aksi 1: Mengajukan Laporan dari Draft ke Kabid
                Action::make('ajukan_laporan')
                    ->label('Ajukan Laporan')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('info')
                    ->visible(fn($record) => $record && (blank($record->status_laporan) || in_array($record->status_laporan, ['draft', 'direvisi'])))
                    ->form([
                        Placeholder::make('info_pelatihan')
                            ->label('Informasi Pelatihan')
                            ->content(fn($record) => "Anda akan mengajukan laporan untuk pelatihan: " . ($record->nama_pelatihan ?? '-')),
                    ])
                    ->action(function ($record): void {
                        if (!$record) return;

                        // Langsung tembak perubahan status ke database secara aman
                        $record->update([
                            'status_laporan' => 'diajukan',
                        ]);

                        Notification::make()
                            ->title('Laporan Berhasil Diajukan')
                            ->body('Laporan kini telah diteruskan ke dashboard Kepala Bidang.')
                            ->success()
                            ->send();
                    })
                    ->modalHeading('Konfirmasi Pengajuan Laporan')
                    ->modalSubmitActionLabel('Lanjutkan & Ajukan'),

                // Tombol Aksi 2: Muncul HANYA KETIKA sudah disetujui Kabid
                Action::make('cetak_laporan')
                    ->label('Unduh PDF')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->color('success')
                    ->visible(fn($record) => $record && $record->status_laporan === 'disetujui')
                    ->url(fn($record) => route('pelatihan.laporan.pdf', $record->id))
                    ->openUrlInNewTab()
            ]);
    }
}
