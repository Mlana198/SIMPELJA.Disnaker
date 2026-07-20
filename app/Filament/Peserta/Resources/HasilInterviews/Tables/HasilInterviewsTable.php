<?php

namespace App\Filament\Peserta\Resources\HasilInterviews\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HasilInterviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', Auth::id()))

            ->columns([
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Jenis Pelatihan')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('status_seleksi_administrasi')
                    ->label('Status Pendaftaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'lolos' => 'success',
                        'tidak_lolos' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Pending / Verifikasi',
                        'lolos' => 'Lolos Administrasi',
                        'tidak_lolos' => 'Tidak Lolos',
                        default => $state,
                    }),

                TextColumn::make('jadwalInterview.penilaianInterview.status_akhir')
                    ->label('Hasil Wawancara')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Lulus' => 'success',
                        'Cadangan' => 'warning',
                        'Gagal' => 'danger',
                        default => 'gray',
                    })
                    ->placeholder('Belum Masuk Wawancara'),

                TextColumn::make('jadwalInterview.penilaianInterview.status_pengajuan')
                    ->label('Pengumuman Akhir (SK)')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Disetujui Kabid' => 'success',
                        'Diajukan Subkoor' => 'warning',
                        default => 'info',
                    })
                    ->formatStateUsing(function ($state, $record) {
                        $statusAkhir = $record->jadwalInterview?->penilaianInterview?->status_akhir;

                        if ($state === 'Disetujui Kabid') {
                            return 'SELAMAT! Anda Diterima';
                        }

                        if ($statusAkhir === 'Lulus') {
                            return 'Lolos Wawancara (Menunggu SK)';
                        }

                        if ($statusAkhir === 'Cadangan') {
                            return 'Posisi Cadangan';
                        }

                        if ($statusAkhir === 'Gagal') {
                            return 'Tidak Lolos Seleksi';
                        }

                        if ($record->status_seleksi_administrasi === 'tidak_lolos') {
                            return 'Pendaftaran Gugur';
                        }

                        return 'Menunggu Jadwal';
                    })
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('downloadSk')
                    ->label('Unduh SK Hasil')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('info')
                    ->button()
                    ->url(function ($record) {
                        $dokumenSk = $record->pelatihan?->dokumenPelatihans()
                            ->where('jenis_dokumen', 'SK')
                            ->first();

                        return $dokumenSk ? asset('storage/' . $dokumenSk->file_path) : '#';
                    })
                    ->openUrlInNewTab()
                    ->visible(function ($record) {
                        if (!$record->pelatihan) {
                            return false;
                        }

                        $dokumenSk = $record->pelatihan->dokumenPelatihans()
                            ->where('jenis_dokumen', 'SK')
                            ->first();

                        return (bool) $dokumenSk;
                    }),


                Action::make('downloadUndangan')
                    ->label('Unduh Undangan')
                    ->icon('heroicon-o-envelope')
                    ->color('success')
                    ->button()
                    ->url(function ($record) {
                        $dokumenUndangan = $record->pelatihan?->dokumenPelatihans()
                            ->where('jenis_dokumen', 'Undangan')
                            ->first();

                        return $dokumenUndangan ? asset('storage/' . $dokumenUndangan->file_path) : '#';
                    })
                    ->openUrlInNewTab()
                    ->visible(function ($record) {

                        if (!$record->pelatihan) return false;

                        $adaUndangan = $record->pelatihan->dokumenPelatihans()
                            ->where('jenis_dokumen', 'Undangan')
                            ->exists();

                        if (!$adaUndangan) return false;

                        return $record->jadwalInterview?->penilaianInterview?->status_pengajuan === 'Disetujui Kabid';
                    }),
            ])
            ->bulkActions([
                //
            ]);
    }
}
