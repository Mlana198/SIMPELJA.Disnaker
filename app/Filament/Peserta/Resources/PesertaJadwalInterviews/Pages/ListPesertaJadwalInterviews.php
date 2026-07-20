<?php

namespace App\Filament\Peserta\Resources\PesertaJadwalInterviews\Pages;

use App\Filament\Peserta\Resources\PesertaJadwalInterviews\PesertaJadwalInterviewResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPesertaJadwalInterviews extends ListRecords
{
    protected static string $resource = PesertaJadwalInterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
