<?php

namespace App\Filament\Resources\JadwalInterviews\Pages;

use App\Filament\Resources\JadwalInterviews\JadwalInterviewResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJadwalInterviews extends ListRecords
{
    protected static string $resource = JadwalInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
