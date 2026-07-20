<?php

namespace App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Pages;

use App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\InstrukturJadwalInterviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInstrukturJadwalInterview extends EditRecord
{
    protected static string $resource = InstrukturJadwalInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
