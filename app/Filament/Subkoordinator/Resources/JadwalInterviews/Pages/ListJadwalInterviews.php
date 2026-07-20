<?php

namespace App\Filament\Subkoordinator\Resources\JadwalInterviews\Pages;

use App\Filament\Subkoordinator\Resources\JadwalInterviews\JadwalInterviewResource;
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
