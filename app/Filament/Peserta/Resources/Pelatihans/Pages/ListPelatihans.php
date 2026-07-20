<?php

namespace App\Filament\Peserta\Resources\Pelatihans\Pages;

use App\Filament\Peserta\Resources\Pelatihans\PelatihanResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPelatihans extends ListRecords
{
    protected static string $resource = PelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
