<?php

namespace App\Filament\Kabid\Resources\PersetujuanSks\Pages;

use App\Filament\Kabid\Resources\PersetujuanSks\PersetujuanSkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersetujuanSk extends EditRecord
{
    protected static string $resource = PersetujuanSkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
