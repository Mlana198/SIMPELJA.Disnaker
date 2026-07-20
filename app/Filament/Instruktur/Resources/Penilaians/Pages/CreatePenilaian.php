<?php

namespace App\Filament\Instruktur\Resources\Penilaians\Pages;

use App\Filament\Instruktur\Resources\Penilaians\PenilaianResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePenilaian extends CreateRecord
{
    protected static string $resource = PenilaianResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['instruktur_id'] = Auth::id();

        return $data;
    }
}
