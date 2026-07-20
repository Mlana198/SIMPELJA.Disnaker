<?php

namespace App\Filament\Subkoordinator\Resources\JadwalInterviews\Pages;

use App\Filament\Subkoordinator\Resources\JadwalInterviews\JadwalInterviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJadwalInterview extends EditRecord
{
    protected static string $resource = JadwalInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
