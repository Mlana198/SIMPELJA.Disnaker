<?php

namespace App\Filament\Instruktur\Resources\Materis\Pages;

use App\Filament\Instruktur\Resources\Materis\MateriResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMateris extends ListRecords
{
    protected static string $resource = MateriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Upload Materi Pelatihan')
                ->icon('heroicon-o-plus'),
        ];
    }
}
