<?php

namespace App\Filament\Kabid\Resources\LaporanPelatihans\Pages;

use App\Filament\Kabid\Resources\LaporanPelatihans\LaporanPelatihanResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanPelatihans extends ListRecords
{
    protected static string $resource = LaporanPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
