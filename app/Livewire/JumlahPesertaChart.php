<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Pelatihan;
use App\Models\Pendaftaran;

class JumlahPesertaChart extends ChartWidget implements HasForms
{
    use InteractsWithForms;

    protected static ?int $sort = 2;

    public ?string $pelatihanId = null;


    private function convertToRoman(int $number): string
    {
        $map = [
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];
        $result = '';
        foreach ($map as $value => $roman) {
            while ($number >= $value) {
                $result .= $roman;
                $number -= $value;
            }
        }
        return $result;
    }
    public function getHeading(): string
    {
        $selectedId = $this->pelatihanId ?? Pelatihan::first()?->id;

        if (!$selectedId) {
            return 'Rasio Kelulusan Peserta';
        }

        $pelatihan = Pelatihan::where('id', $selectedId)->first(['nama_pelatihan', 'angkatan']);

        if (!$pelatihan) {
            return 'Rasio Kelulusan Peserta';
        }

        $angkatanRomawi = $this->convertToRoman((int) $pelatihan->angkatan);

        return "Rasio Kelulusan: {$pelatihan->nama_pelatihan} {$angkatanRomawi}";
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('pelatihanId')
                ->label('Pilih Pelatihan')
                ->placeholder('Pilih Pelatihan')
                ->options(
                    Pelatihan::all()->mapWithKeys(function ($item) {
                        $romawi = $this->convertToRoman((int) $item->angkatan);
                        return [$item->id => "{$item->nama_pelatihan} {$romawi}"];
                    })
                )
                ->live()
                ->afterStateUpdated(fn() => $this->updateChartData()),
        ];
    }

    protected function getData(): array
    {
        $selectedId = $this->pelatihanId ?? Pelatihan::first()?->id;

        if (!$selectedId) {
            return ['datasets' => [], 'labels' => []];
        }

        $totalLulus = Pendaftaran::where('pelatihans_id', $selectedId)
            ->where('status_kelulusan', 'lulus')
            ->count();

        $totalPending = Pendaftaran::where('pelatihans_id', $selectedId)
            ->where('status_kelulusan', 'pending')
            ->count();

        $totalTidakLulus = Pendaftaran::where('pelatihans_id', $selectedId)
            ->where('status_kelulusan', 'tidak_lulus')
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peserta',
                    'data' => [$totalLulus, $totalPending, $totalTidakLulus],
                    'backgroundColor' => [
                        '#3b82f6',
                        '#f59e0b',
                        '#f43f5e',
                    ],
                ],
            ],
            'labels' => ['Peserta Lulus', 'Pending / Menunggu', 'Tidak Lulus'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
