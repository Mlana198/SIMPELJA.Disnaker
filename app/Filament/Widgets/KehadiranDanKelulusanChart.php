<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Pelatihan;
use App\Models\Pendaftaran;
use App\Models\Absensi;

class KehadiranDanKelulusanChart extends ChartWidget implements HasForms
{
    use InteractsWithForms;

    public ?string $pelatihanId = null;

    public function getHeading(): string
    {
        $selectedId = $this->pelatihanId ?? Pelatihan::first()?->id;

        if (!$selectedId) {
            return 'Grafik Evaluasi & Monitoring Pelatihan';
        }

        $namaPelatihan = Pelatihan::where('id', $selectedId)->value('nama_pelatihan');
        return "Monitoring Evaluasi: Kelas " . $namaPelatihan;
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('pelatihanId')
                ->label('Pilih Jenis Pelatihan')
                ->placeholder('Pilih Pelatihan untuk memfilter data')
                ->options(
                    Pelatihan::pluck('nama_pelatihan', 'id')
                )
                ->live()
                ->afterStateUpdated(function () {
                    $this->updateChartData();
                }),
        ];
    }

    protected function getData(): array
    {
        $selectedId = $this->pelatihanId ?? Pelatihan::first()?->id;

        if (!$selectedId) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        // 1. Menghitung total pendaftar pada pelatihan terpilih
        $totalPendaftar = Pendaftaran::where('pelatihans_id', $selectedId)->count();

        // 2. REVISI: Hitung langsung dari tabel pendaftaran berdasarkan kolom status_kelulusan
        $totalLulus = Pendaftaran::where('pelatihans_id', $selectedId)
            ->where('status_kelulusan', 'lulus')
            ->count();

        $totalSesiAbsen = Absensi::where('pelatihans_id', $selectedId)->count();
        $totalHadir = Absensi::where('pelatihans_id', $selectedId)
            ->whereIn('status_kehadiran', ['hadir', 'Hadir'])
            ->count();
        $persentaseKehadiran = $totalSesiAbsen > 0 ? round(($totalHadir / $totalSesiAbsen) * 100) : 0;

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peserta (Orang)',
                    'data' => [$totalPendaftar, $totalLulus, null],
                    'backgroundColor' => ['#3b82f6', '#10b981', '#00000000'],
                    'maxBarThickness' => 30,
                ],
                [
                    'label' => 'Tren Kehadiran Kelas (%)',
                    'data' => [null, null, $persentaseKehadiran],
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#f59e0b',
                    'type' => 'line',
                    'fill' => false,
                ],
            ],
            'labels' => ['Total Pendaftar', 'Peserta Lulus Pelatihan', 'Rata-rata Kehadiran (%)'],
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
        return 'bar';
    }
}
