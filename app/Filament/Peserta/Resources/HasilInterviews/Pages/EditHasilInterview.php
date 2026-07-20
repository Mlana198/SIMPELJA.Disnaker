<?php

namespace App\Filament\Peserta\Resources\HasilInterviews\Pages;

use App\Filament\Peserta\Resources\HasilInterviews\HasilInterviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHasilInterview extends EditRecord
{
    protected static string $resource = HasilInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
