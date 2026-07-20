<?php

namespace App\Filament\Instruktur\Resources\Penilaians\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
                    ->label('Teori')
                    ->sortable(),
                TextColumn::make('nilai_praktek')
                    ->label('Praktek')
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
                TextColumn::make('catatan_instruktur')
                    ->label('Catatan Instruktur')
                    ->wrap(),
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
                    DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('instruktur_id', Auth::id())->with(['user.profil']);
            });
    }
}
