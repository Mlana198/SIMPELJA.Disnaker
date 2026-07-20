<?php

namespace App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class PengajuanPendaftaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('buktiPendaftaran.nomor_registrasi')
                    ->label('Nomor Pendaftaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.profil.nama_lengkap')
                    ->label('Nama Peserta')
                    ->searchable(),

                TextColumn::make('user.nomor_identitas')
                    ->label('NIK')
                    ->searchable(),

                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Program Pelatihan'),

                TextColumn::make('catatan_keputusan')
                    ->label('Status Dokumen')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'diajukan_ke_subkor'     => 'warning',
                        'dijadwalkan_interview'  => 'info',
                        'pendaftaran_diterima'   => 'success',
                        'ditolak_subkor'         => 'danger',
                        default                  => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'diajukan_ke_subkor'     => 'Menunggu Persetujuan',
                        'dijadwalkan_interview'  => 'Rekomendasi Wawancara',
                        'pendaftaran_diterima'   => 'Disetujui (Lolos Final)',
                        'ditolak_subkor'         => 'Ditolak',
                        default                  => $state,
                    }),
            ])
            ->filters([
                //    
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([

                    // AKSI 1: SETUJUI LANGSUNG (LOLOS FINAL TANPA INTERVIEW)
                    BulkAction::make('setujuiKolektif')
                        ->label('Verifikasi & Setujui (Lolos Final)')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            foreach ($records as $pendaftaran) {
                                $pendaftaran->update([
                                    'catatan_keputusan' => 'pendaftaran_diterima',
                                ]);
                            }

                            Notification::make()
                                ->title('Pengajuan Disetujui')
                                ->body($records->count() . ' data pendaftar telah sah diterima dalam pelatihan.')
                                ->success()
                                ->send();
                        }),

                    // AKSI 2: REKOMENDASIKAN INTERVIEW (LEMPAR KE HALAMAN JADWAL)
                    BulkAction::make('rekomendasiInterviewKolektif')
                        ->label('Rekomendasikan ke Tahap Wawancara')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->color('info')
                        ->requiresConfirmation()
                        ->modalHeading('Teruskan ke Tahap Wawancara')
                        ->modalDescription('Data yang dipilih akan dialihkan ke halaman Jadwal Wawancara untuk ditentukan waktu dan tempatnya.')
                        ->action(function (Collection $records) {
                            foreach ($records as $pendaftaran) {
                                $pendaftaran->update([
                                    'catatan_keputusan' => 'dijadwalkan_interview',
                                ]);
                            }

                            Notification::make()
                                ->title('Berhasil Diteruskan')
                                ->body($records->count() . ' data pendaftar dipindahkan ke pengelolaan Jadwal Wawancara.')
                                ->success()
                                ->send();
                        }),

                    // AKSI 3: TOLAK PENGAJUAN
                    BulkAction::make('tolakKolektif')
                        ->label('Tolak Pengajuan Berkas')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Tolak Pengajuan Kolektif')
                        ->modalDescription('Apakah Anda yakin ingin menolak berkas pendaftaran yang dipilih?')
                        ->action(function (Collection $records) {
                            foreach ($records as $pendaftaran) {
                                $pendaftaran->update([
                                    'catatan_keputusan' => 'ditolak_subkor',
                                ]);
                            }

                            Notification::make()
                                ->title('Pengajuan Ditolak')
                                ->body($records->count() . ' data pendaftaran telah ditolak sistem.')
                                ->danger()
                                ->send();
                        }),
                ]),
            ]);
    }
}
