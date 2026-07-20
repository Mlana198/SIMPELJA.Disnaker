<?php

namespace App\Filament\Peserta\Resources\Pelatihans\Pages;

use App\Filament\Peserta\Resources\Pelatihans\PelatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPelatihan extends EditRecord
{
    protected static string $resource = PelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
