<?php

namespace App\Filament\Instruktur\Resources\Materis\Pages;

use App\Filament\Instruktur\Resources\Materis\MateriResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditMateri extends EditRecord
{
    protected static string $resource = MateriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['uploaded_by'] = Auth::id();

        return $data;
    }
}
