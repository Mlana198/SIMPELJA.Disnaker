<?php

namespace App\Filament\Resources\PenilaianInterviews\Pages;

use App\Filament\Resources\PenilaianInterviews\PenilaianInterviewResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenilaianInterviews extends ListRecords
{
    protected static string $resource = PenilaianInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
