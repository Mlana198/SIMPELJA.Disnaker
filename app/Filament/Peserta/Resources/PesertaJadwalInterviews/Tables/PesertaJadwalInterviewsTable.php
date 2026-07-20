<?php

namespace App\Filament\Peserta\Resources\PesertaJadwalInterviews\Tables;


use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PesertaJadwalInterviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->whereHas('pendaftaran', function ($q) {
                    $q->where('user_id', Auth::id())
                        ->where('is_notified', true);
                })->with(['pendaftaran.pelatihan', 'interviewer.profil']);
            })
            ->columns([
                TextColumn::make('pendaftaran.pelatihan.nama_pelatihan')
                    ->label('Jenis Pelatihan')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('waktu_interview')
                    ->label('Tanggal & Waktu')
                    ->dateTime('d M Y - H:i'),

                TextColumn::make('tempat_atau_link')
                    ->label('Tempat / Link Wawancara')
                    ->copyable()
                    ->copyMessage('Link disalin!'),

                TextColumn::make('interviewer.profil.nama_lengkap')
                    ->label('Instruktur Penguji')
                    ->placeholder('Belum Ditunjuk')
                    ->badge()
                    ->color('info'),
            ])
            ->filters([
                //
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
