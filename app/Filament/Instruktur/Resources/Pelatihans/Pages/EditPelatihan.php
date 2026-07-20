<?php

namespace App\Filament\Instruktur\Resources\Pelatihans\Pages;

use App\Filament\Instruktur\Resources\Pelatihans\PelatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPelatihan extends EditRecord
{
    protected static string $resource = PelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
