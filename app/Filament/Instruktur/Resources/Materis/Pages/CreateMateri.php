<?php

namespace App\Filament\Instruktur\Resources\Materis\Pages;

use App\Filament\Instruktur\Resources\Materis\MateriResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateMateri extends CreateRecord
{
    protected static string $resource = MateriResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uploaded_by'] = Auth::id();

        return $data;
    }
}
