<?php

namespace App\Filament\Peserta\Resources\Kelulusans\Pages;

use App\Filament\Peserta\Resources\Kelulusans\KelulusanResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKelulusans extends ListRecords
{
    protected static string $resource = KelulusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
