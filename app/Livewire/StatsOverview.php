<?php

namespace App\Livewire;

use App\Models\Pelatihan;
use App\Models\Pendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendaftar', Pendaftaran::count())
                ->description('Seluruh pendaftar pelatihan')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Peserta Lulus', Pendaftaran::where('status_kelulusan', 'lulus')->count())
                ->description('Peserta yang dinyatakan lulus')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Pelatihan Aktif', Pelatihan::where('status_periode', 'aktif')->count())
                ->description('Selesai: ' . Pelatihan::where('status_periode', 'selesai')->count() . ' | Non-Aktif: ' . Pelatihan::where('status_periode', 'non-aktif')->count())
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning'),
        ];
    }
}
