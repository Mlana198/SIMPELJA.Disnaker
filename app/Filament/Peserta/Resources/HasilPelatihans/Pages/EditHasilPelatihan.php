<?php

namespace App\Filament\Peserta\Resources\HasilPelatihans\Pages;

use App\Filament\Peserta\Resources\HasilPelatihans\HasilPelatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHasilPelatihan extends EditRecord
{
    protected static string $resource = HasilPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
