<?php

namespace App\Filament\Peserta\Resources\Pendaftarans\Pages;

use App\Filament\Peserta\Resources\Pendaftarans\PendaftaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPendaftaran extends EditRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
