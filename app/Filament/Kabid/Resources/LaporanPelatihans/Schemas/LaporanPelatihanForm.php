<?php

namespace App\Filament\Kabid\Resources\LaporanPelatihans\Schemas;

use App\Models\Penilaian;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LaporanPelatihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Grid::make(2)->schema([
                        TextInput::make('nama_pelatihan_display')
                            ->label('Nama Pelatihan')
                            ->disabled()
                            ->afterStateHydrated(function ($component, $record) {
                                $component->state($record->nama_pelatihan ?? '-');
                            }),
                        TextInput::make('tanggal_pelaporan')
                            ->label('Tanggal Pelaporan')
                            ->type('date')
                            ->disabled()
                            ->afterStateHydrated(function ($component, $record) {
                                $component->state($record->updated_at?->format('Y-m-d') ?? now()->format('Y-m-d'));
                            }),
                        TextInput::make('total_pendaftar')
                            ->label('Total Pendaftar Lolos Administrasi')
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
                            ->label('Total Peserta Lulus')
                            ->disabled()
                            ->afterStateHydrated(function ($component, $record) {
                                if (!$record) return;
                                $count = $record->pendaftarans()
                                    ->whereHas('user.penilaians', function ($query) use ($record) {
                                        $query->where('pelatihans_id', $record->id);
                                    })->count();
                                $component->state($count);
                            }),
                        TextInput::make('rata_rata_nilai')
                            ->label('Rata-Rata Nilai')
                            ->disabled()
                            ->afterStateHydrated(function ($component, $record) {
                                if (!$record) return;
                                $avg = Penilaian::where('pelatihans_id', $record->id)
                                    ->avg('nilai_akhir') ?? 0;
                                $component->state(round($avg, 2));
                            }),
                    ]),

                    Section::make('Aksi Kepala Bidang')
                        ->schema([
                            Select::make('status_laporan')
                                ->label('Persetujuan Laporan')
                                ->options([
                                    0 => 'Kembalikan / Minta Revisi',
                                    1 => 'Setujui Laporan & Buka Menu Kelulusan',
                                    2 => 'Tolak Laporan'
                                ])
                                ->required()
                                ->afterStateHydrated(function ($component, $record) {
                                    if (!$record) return;

                                    $initialState = match ($record->status_laporan) {
                                        'disetujui' => 1,
                                        'direvisi' => 0,
                                        'ditolak' => 2,
                                        default => null,
                                    };

                                    $component->state($initialState);
                                }),

                            Textarea::make('catatan_revisi')
                                ->label('Catatan Validasi / Instruksi Revisi')
                                ->placeholder('Berikan alasan jika menolak/revisi, atau catatan jika menyetujui...')
                                ->rows(3),
                        ])
                ])
            ]);
    }
}
