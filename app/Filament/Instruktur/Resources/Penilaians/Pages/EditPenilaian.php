<?php

namespace App\Filament\Instruktur\Resources\Penilaians\Pages;

use App\Filament\Instruktur\Resources\Penilaians\PenilaianResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPenilaian extends EditRecord
{
    protected static string $resource = PenilaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
