<?php

namespace App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Pages;

use App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\PengajuanPendaftaranResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPengajuanPendaftarans extends ListRecords
{
    protected static string $resource = PengajuanPendaftaranResource::class;

    public static function getEloquentQuery(): Builder
    {

        return parent::getEloquentQuery();
    }

    public function getTabs(): array
    {
        return [
            //
        ];
    }
}
