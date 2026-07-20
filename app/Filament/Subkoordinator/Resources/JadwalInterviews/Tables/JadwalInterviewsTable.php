<?php

namespace App\Filament\Subkoordinator\Resources\JadwalInterviews\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class JadwalInterviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->with([
                    'buktiPendaftaran',
                    'jadwalInterview.penilaianInterview',
                    'jadwalInterview.interviewer.profil',
                    'user.profil'
                ])
                    ->where('catatan_keputusan', 'dijadwalkan_interview');
            })
            ->columns([
                TextColumn::make('buktiPendaftaran.nomor_registrasi')
                    ->label('Nomor Registrasi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.profil.nama_lengkap')
                    ->label('Calon Peserta')
                    ->searchable(),

                TextColumn::make('jadwalInterview.penilaianInterview.status_akhir')
                    ->label('Rekomendasi Instruktur')
                    ->badge()
                    ->color(fn($state) => $state === 'Lulus' ? 'success' : 'danger'),

                TextColumn::make('jadwalInterview.penilaianInterview.status_pengajuan')
                    ->label('Status Pengajuan')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Draft' => 'gray',
                        'Diajukan Subkoor' => 'warning',
                        'Disetujui Kabid' => 'success',
                        default => 'primary'
                    }),

                TextColumn::make('jadwalInterview.waktu_interview')
                    ->label('Tanggal & Waktu')
                    ->dateTime('d M Y - H:i')
                    ->description(fn($record) => $record->jadwalInterview?->tempat_atau_link === 'Belum Diatur' ? '(Jadwal Belum Fix)' : '')
                    ->color(fn($record) => $record->jadwalInterview?->tempat_atau_link === 'Belum Diatur' ? 'warning' : 'transparent'),

                TextColumn::make('jadwalInterview.interviewer.profil.nama_lengkap')
                    ->label('Instruktur Penguji')
                    ->placeholder('Belum Ditunjuk')
                    ->badge()
                    ->color(fn($state) => $state ? 'success' : 'warning'),
            ])
            ->filters([
                SelectFilter::make('status_pengajuan')
                    ->label('Filter Status')
                    ->options([
                        'Draft' => 'Siap Diajukan (Draft)',
                        'Diajukan Subkoor' => 'Sudah Diajukan ke Kabid',
                        'Disetujui Kabid' => 'Sudah Disetujui Kabid',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (! empty($data['value'])) {
                            $query->whereHas('jadwalInterview.penilaianInterview', function ($subQuery) use ($data) {
                                $subQuery->where('status_pengajuan', $data['value']);
                            });
                        }
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('ajukan_ke_kabid')
                        ->label('Ajukan ke Kabid')
                        ->icon('heroicon-o-paper-airplane')
                        ->color('warning')
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                $jadwalId = $record->jadwalInterview?->id;

                                if ($jadwalId) {
                                    DB::table('penilaian_interviews')
                                        ->where('jadwal_interview_id', $jadwalId)
                                        ->where('status_pengajuan', 'Draft')
                                        ->update(['status_pengajuan' => 'Diajukan Subkoor']);
                                }
                            }
                        })
                        ->requiresConfirmation()
                        ->successNotificationTitle('Data terpilih berhasil diajukan ke Kepala Bidang!'),
                ]),
            ]);
    }
}
