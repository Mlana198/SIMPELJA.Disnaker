<?php

namespace App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Pages;

use App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\InstrukturJadwalInterviewResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInstrukturJadwalInterviews extends ListRecords
{
    protected static string $resource = InstrukturJadwalInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
