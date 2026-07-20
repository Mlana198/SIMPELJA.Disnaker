<?php

namespace App\Filament\Resources\Penilaians\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Spatie\SimpleExcel\SimpleExcelWriter;

class PenilaiansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Pelatihan')
                    ->sortable(),
                TextColumn::make('user_id')
                    ->label('Peserta')
                    ->getStateUsing(function ($record) {
                        // Ambil nama langsung dari tabel profil_pengguna berdasarkan user_id di record penilaian
                        $profil = \App\Models\ProfilPengguna::where('user_id', $record->user_id)->first();

                        return $profil ? $profil->nama_lengkap : ($record->user?->name ?? 'Pengguna');
                    })
                    ->searchable(query: function (\Illuminate\Database\Eloquent\Builder $query, string $search): \Illuminate\Database\Eloquent\Builder {
                        return $query->whereHas('user', function ($q) use ($search) {
                            $q->whereHas('profil', function ($qp) use ($search) {
                                $qp->where('nama_lengkap', 'like', "%{$search}%");
                            });
                        });
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nilai_teori')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nilai_praktek')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->badge()
                    ->color('primary')
                    ->getStateUsing(function ($record) {
                        if (blank($record->nilai_akhir)) {
                            return ((float)$record->nilai_teori + (float)$record->nilai_praktek) / 2;
                        }
                        return $record->nilai_akhir;
                    })
                    ->sortable(),
                TextColumn::make('instruktur.name')
                    ->label('Instruktur Penilai')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('exportExcel')
                        ->label('Download Rekap (Excel/CSV)')
                        ->icon('heroicon-m-arrow-down-tray')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $fileName = 'rekap-penilaian-' . now()->format('Ymd-His') . '.xlsx';
                            $filePath = storage_path('app/public/' . $fileName);

                            $writer = SimpleExcelWriter::create($filePath)
                                ->addHeader([
                                    'Nama Pelatihan',
                                    'Nama Peserta',
                                    'Nilai Teori',
                                    'Nilai Praktek',
                                    'Nilai Akhir',
                                    'Catatan Instruktur'
                                ]);

                            foreach ($records as $record) {
                                // Kalkulasi nilai akhir secara dinamis
                                $nilaiAkhir = ($record->nilai_teori + $record->nilai_praktek) / 2;

                                $writer->addRow([
                                    $record->pelatihan?->nama_pelatihan ?? '-',
                                    $record->user?->profil?->nama_lengkap ?? '-',
                                    $record->nilai_teori,
                                    $record->nilai_praktek,
                                    $nilaiAkhir,
                                    $record->catatan_instruktur ?? '-',
                                ]);
                            }

                            $writer->close();

                            return response()->download($filePath)->deleteFileAfterSend(true);
                        }),
                ]),
            ]);
    }
}
