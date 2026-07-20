<?php

namespace App\Filament\Instruktur\Resources\Pelatihans\Pages;

use App\Filament\Instruktur\Resources\Pelatihans\PelatihanResource;
use App\Filament\Instruktur\Resources\Pelatihans\RelationManagers\AbsensisRelationManager;
use Filament\Resources\Pages\ViewRecord;

class ViewPelatihan extends ViewRecord
{
    protected static string $resource = PelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Absensi ' . $this->getRecord()->nama_pelatihan;
    }

    public function getRelationManagers(): array
    {
        return [
            AbsensisRelationManager::class,
        ];
    }
}
