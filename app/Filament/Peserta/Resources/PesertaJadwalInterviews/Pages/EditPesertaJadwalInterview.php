<?php

namespace App\Filament\Peserta\Resources\PesertaJadwalInterviews\Pages;

use App\Filament\Peserta\Resources\PesertaJadwalInterviews\PesertaJadwalInterviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPesertaJadwalInterview extends EditRecord
{
    protected static string $resource = PesertaJadwalInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
