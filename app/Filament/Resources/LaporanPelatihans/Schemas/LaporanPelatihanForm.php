<?php

namespace App\Filament\Resources\LaporanPelatihans\Schemas;

use App\Models\Penilaian;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LaporanPelatihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Statistik Hasil Pelatihan (Dihitung Otomatis)')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama_pelatihan')
                                ->label('Nama Pelatihan')
                                ->disabled(),

                            TextInput::make('total_pendaftar')
                                ->label('Pendaftar Lolos Seleksi Administrasi')
                                ->disabled()
                                ->afterStateHydrated(function ($component, $record) {
                                    if (!$record) {
                                        $component->state(0);
                                        return;
                                    }

                                    $count = $record->pendaftarans()
                                        ->where('status_seleksi_administrasi', 'lolos')
                                        ->count();

                                    $component->state($count);
                                }),

                            TextInput::make('total_peserta_lulus')
                                ->label('Peserta Lulus (Penilaian Instruktur)')
                                ->disabled()
                                ->afterStateHydrated(function ($component, $record) {
                                    if (!$record) {
                                        $component->state(0);
                                        return;
                                    }

                                    $count = $record->pendaftarans()
                                        ->whereHas('user.penilaians', function ($query) use ($record) {
                                            $query->where('pelatihans_id', $record->id);
                                        })->count();

                                    $component->state($count);
                                }),

                            TextInput::make('rata_rata_nilai')
                                ->label('Rata-Rata Nilai Kelas')
                                ->disabled()
                                ->afterStateHydrated(function ($component, $record) {
                                    if (!$record) {
                                        $component->state(0);
                                        return;
                                    }
                                    $avg = Penilaian::where('pelatihans_id', $record->id)
                                        ->avg('nilai_akhir') ?? 0;
                                    $component->state(round($avg, 2));
                                }),
                        ]),
                    ]),

                Section::make('Catatan dari Kepala Bidang')
                    ->schema([
                        Textarea::make('catatan_revisi')
                            ->label('Catatan Validasi / Instruksi Revisi terakhir')
                            ->disabled()
                            ->placeholder('Tidak ada catatan revisi.')
                            ->rows(3),
                    ])
                    ->visible(fn ($record) => $record && filled($record->catatan_revisi)),
            ]);
    }
}