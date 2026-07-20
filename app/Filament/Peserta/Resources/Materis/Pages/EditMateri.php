<?php

namespace App\Filament\Peserta\Resources\Materis\Pages;

use App\Filament\Peserta\Resources\Materis\MateriResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMateri extends EditRecord
{
    protected static string $resource = MateriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
