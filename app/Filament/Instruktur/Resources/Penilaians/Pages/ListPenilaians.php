<?php

namespace App\Filament\Instruktur\Resources\Penilaians\Pages;

use App\Filament\Instruktur\Resources\Penilaians\PenilaianResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenilaians extends ListRecords
{
    protected static string $resource = PenilaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
