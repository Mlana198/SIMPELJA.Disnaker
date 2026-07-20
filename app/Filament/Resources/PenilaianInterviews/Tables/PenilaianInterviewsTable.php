<?php

namespace App\Filament\Resources\PenilaianInterviews\Tables;

use Filament\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class PenilaianInterviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jadwalInterview.pendaftaran.user.name')
                    ->label('Nama Peserta')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jadwalInterview.pendaftaran.user.nomor_identitas')
                    ->label('NIK')
                    ->searchable(),

                TextColumn::make('jadwalInterview.pendaftaran.user.profil.gender')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                        default => $state,
                    }),

                TextColumn::make('ttl')
                    ->label('Tempat, Tgl Lahir')
                    ->getStateUsing(function ($record) {
                        $user = $record->jadwalInterview->pendaftaran->user;
                        $profile = $user->profil;

                        return ($profile->tempat_lahir ?? '-') . ', ' . ($profile->tanggal_lahir ?? '-');
                    }),

                TextColumn::make('skor_minat')
                    ->label('Minat')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('skor_bakat')
                    ->label('Bakat')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('status_akhir')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Lulus' => 'success',
                        'Cadangan' => 'warning',
                        'Gagal' => 'danger',
                        default => 'secondary',
                    })
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status_akhir')
                    ->options([
                        'Lulus' => 'Lulus',
                        'Cadangan' => 'Cadangan',
                        'Gagal' => 'Gagal',
                    ]),
            ])
            ->recordActions([
                // ViewAction::make(),
            ])
            ->toolbarActions([
                BulkAction::make('unduh_pdf')
                    ->label('Unduh Data Peserta (PDF)')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('danger')
                    ->action(function (Collection $records) {

                        $ids = $records->pluck('id')->implode(',');

                        return redirect()->route(
                            'penilaian-interview.pdf',
                            ['ids' => $ids]
                        );
                    })
                    ->requiresConfirmation(),
            ]);
    }
}
