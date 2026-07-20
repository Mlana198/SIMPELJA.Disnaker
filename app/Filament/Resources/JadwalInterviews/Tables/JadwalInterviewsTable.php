<?php

namespace App\Filament\Resources\JadwalInterviews\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JadwalInterviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->with([
                    'pendaftaran.pelatihan',
                    'pendaftaran.user.profil',
                    'pendaftaran.buktiPendaftaran',
                    'interviewer.profil'
                ]);
            })

            ->columns([
                TextColumn::make('pendaftaran.buktiPendaftaran.nomor_registrasi')
                    ->label('Nomor Registrasi')
                    ->placeholder('Belum Ada'),

                TextColumn::make('pendaftaran.pelatihan.nama_pelatihan')
                    ->label('Jenis Pelatihan')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('pendaftaran.user.profil.nama_lengkap')
                    ->label('Nama Calon Peserta')
                    ->searchable(),

                TextColumn::make('waktu_interview')
                    ->label('Tanggal & Waktu')
                    ->dateTime('d M Y - H:i')
                    ->sortable(),

                TextColumn::make('tempat_atau_link')
                    ->label('Tempat / Link')
                    ->placeholder('Belum Diatur'),

                TextColumn::make('interviewer.profil.nama_lengkap')
                    ->label('Instruktur Penguji')
                    ->placeholder('Belum Ditunjuk')
                    ->badge()
                    ->color(fn($state) => $state ? 'success' : 'warning'),

                TextColumn::make('pendaftaran.is_notified')
                    ->label('Status Notifikasi')
                    ->badge()
                    ->color(fn($state): string => $state ? 'success' : 'warning')
                    ->formatStateUsing(fn($state): string => $state ? 'Sudah Diteruskan' : 'Belum Diteruskan'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('teruskanKePeserta')
                    ->label('Teruskan ke Peserta')
                    ->icon('heroicon-o-share')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Teruskan Jadwal Wawancara')
                    ->modalDescription('Aksi ini akan meneruskan notifikasi jadwal wawancara agar dapat dilihat langsung oleh akun peserta.')

                    ->hidden(fn($record) => (bool) $record->pendaftaran?->is_notified === true)

                    ->action(function ($record) {
                        if ($record->pendaftaran) {
                            $record->pendaftaran->update([
                                'is_notified' => true,
                            ]);

                            $record->load('pendaftaran');
                        }

                        Notification::make()
                            ->title('Jadwal Berhasil Diteruskan')
                            ->body('Informasi waktu dan tempat wawancara kini sudah dapat diakses oleh peserta.')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // 
                ]),
            ]);
    }
}
