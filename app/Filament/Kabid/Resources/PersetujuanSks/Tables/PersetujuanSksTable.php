<?php

namespace App\Filament\Kabid\Resources\PersetujuanSks\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PersetujuanSksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // KOREKSI 1: Hapus modifyQueryUsing global agar filter dikendalikan penuh oleh Tabs Navigasi Pages
            ->columns([
                TextColumn::make('id')
                    ->label('ID Pendaftaran')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.profil.nama_lengkap')
                    ->label('Nama Calon Peserta')
                    ->searchable(),

                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Program Pelatihan')
                    ->badge(),

                TextColumn::make('jadwalInterview.penilaianInterview.status_akhir')
                    ->label('Rekomendasi Instruktur')
                    ->badge()
                    ->color(fn($state) => $state === 'Lulus' ? 'success' : 'danger'),

                TextColumn::make('jadwalInterview.penilaianInterview.status_pengajuan')
                    ->label('Status Validasi')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Diajukan Subkoor' => 'warning',
                        'Disetujui Kabid' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            // KOREKSI 2: Pindahkan BulkAction dari toolbarActions ke dalam bulkActions bawaan Filament yang benar
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('setujui_kabid')
                        ->label('Setujui & Validasi Peserta')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                $jadwalId = $record->jadwalInterview?->id;

                                if ($jadwalId) {
                                    DB::table('penilaian_interviews')
                                        ->where('jadwal_interview_id', $jadwalId)
                                        ->where('status_pengajuan', 'Diajukan Subkoor')
                                        ->update([
                                            'status_pengajuan' => 'Disetujui Kabid'
                                        ]);
                                }
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Setujui Calon Peserta Pelatihan')
                        ->modalDescription('Apakah Anda yakin ingin menyetujui daftar peserta ini? Status akan berubah menjadi "Disetujui Kabid" dan siap dicetak untuk SK fisik.')
                        ->successNotificationTitle('Daftar peserta berhasil disetujui!'),
                ]),
            ]);
    }
}
