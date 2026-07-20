<?php

namespace App\Filament\Resources\PenilaianInterviews\Pages;

use App\Filament\Resources\PenilaianInterviews\PenilaianInterviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianInterview extends EditRecord
{
    protected static string $resource = PenilaianInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
