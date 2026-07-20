<?php

namespace App\Filament\Peserta\Resources\Kelulusans\Pages;

use App\Filament\Peserta\Resources\Kelulusans\KelulusanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKelulusan extends EditRecord
{
    protected static string $resource = KelulusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
