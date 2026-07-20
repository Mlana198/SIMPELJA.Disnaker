<?php

namespace App\Filament\Kabid\Resources\PersetujuanSks\Pages;

use App\Filament\Kabid\Resources\PersetujuanSks\PersetujuanSkResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListPersetujuanSks extends ListRecords
{
    protected static string $resource = PersetujuanSkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'perlu_validasi' => Tab::make('Perlu Verifikasi')
                ->badge(fn() => \App\Models\Pendaftaran::whereHas('jadwalInterview.penilaianInterview', function ($subQuery) {
                    $subQuery->where('status_pengajuan', 'Diajukan Subkoor')->where('status_akhir', 'Lulus');
                })->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('jadwalInterview.penilaianInterview', function ($subQuery) {
                    $subQuery->where('status_pengajuan', 'Diajukan Subkoor')->where('status_akhir', 'Lulus');
                })),

            'sudah_disetujui' => Tab::make('Sudah Disetujui')
                ->badge(fn() => \App\Models\Pendaftaran::whereHas('jadwalInterview.penilaianInterview', function ($subQuery) {
                    $subQuery->where('status_pengajuan', 'Disetujui Kabid');
                })->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('jadwalInterview.penilaianInterview', function ($subQuery) {
                    $subQuery->where('status_pengajuan', 'Disetujui Kabid');
                })),
        ];
    }
}
