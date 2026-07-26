<?php

namespace App\Filament\Peserta\Resources\Pelatihans\Pages;

use App\Filament\Peserta\Resources\Pelatihans\PelatihanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPelatihan extends ViewRecord
{
    protected static string $resource = PelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
