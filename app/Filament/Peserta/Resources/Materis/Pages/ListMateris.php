<?php

namespace App\Filament\Peserta\Resources\Materis\Pages;

use App\Filament\Peserta\Resources\Materis\MateriResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMateris extends ListRecords
{
    protected static string $resource = MateriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
