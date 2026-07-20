<?php

namespace App\Filament\Kabid\Resources\PersetujuanSks\Schemas;



use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PersetujuanSkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lembar Verifikasi Hasil Seleksi')
                    ->description('Tinjau kesesuaian data hasil interview dari instruktur sebelum divalidasi.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Placeholder::make('nama_peserta')
                                    ->label('Nama Calon Peserta')
                                    ->content(fn($record) => $record->user?->profil?->nama_lengkap ?? '-'),

                                Placeholder::make('program_pelatihan')
                                    ->label('Program Pelatihan')
                                    ->content(fn($record) => $record->pelatihan?->nama_pelatihan ?? '-'),

                                Placeholder::make('rekomendasi_instruktur')
                                    ->label('Rekomendasi Instruktur (Hasil Wawancara)')
                                    ->content(fn($record) => $record->jadwalInterview?->penilaianInterview?->status_akhir ?? '-'),

                                Placeholder::make('catatan_kualitatif')
                                    ->label('Catatan Hasil Interview')
                                    ->content(fn($record) => strip_tags($record->jadwalInterview?->penilaianInterview?->catatan_kualitatif ?? 'Tidak ada catatan')),
                            ]),
                    ]),
            ]);
    }
}
