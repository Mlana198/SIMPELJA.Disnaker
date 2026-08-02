<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Pelatihan;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class RataRataKehadiranChart extends ChartWidget implements HasForms
{
    use InteractsWithForms;

    protected static ?int $sort = 3;

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
            return 'Tren Kehadiran Sesi Pelatihan';
        }

        $pelatihan = Pelatihan::where('id', $selectedId)->first(['nama_pelatihan', 'angkatan']);

        if (!$pelatihan) {
            return 'Tren Kehadiran Sesi Pelatihan';
        }

        $angkatanRomawi = $this->convertToRoman((int) $pelatihan->angkatan);

        return "Tren Kehadiran Sesi: {$pelatihan->nama_pelatihan} {$angkatanRomawi}";
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

        $absensiPerTanggal = Absensi::where('pelatihans_id', $selectedId)
            ->select(
                'tanggal',
                DB::raw('COUNT(*) as total_sesi'),
                DB::raw("SUM(CASE WHEN status_kehadiran IN ('hadir', 'Hadir') THEN 1 ELSE 0 END) as total_hadir")
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labels = [];
        $dataKehadiran = [];

        foreach ($absensiPerTanggal as $absen) {
            $labels[] = \Carbon\Carbon::parse($absen->tanggal)->format('d M y');

            $persentase = $absen->total_sesi > 0
                ? round(($absen->total_hadir / $absen->total_sesi) * 100)
                : 0;

            $dataKehadiran[] = $persentase;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Persentase Kehadiran (%)',
                    'data' => $dataKehadiran,
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.15)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
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
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'suggestedMax' => 100,
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
