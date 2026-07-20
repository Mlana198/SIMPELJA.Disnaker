<?php

namespace App\Filament\Resources\Kelulusans\Pages;

use App\Filament\Resources\Kelulusans\KelulusanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKelulusan extends EditRecord
{
    protected static string $resource = KelulusanResource::class;

    public function getTitle(): string
    {
        $namaLengkap = $this->record->user?->profil?->nama_lengkap
            ?? $this->record->user?->name
            ?? 'Peserta';

        return "Evaluasi Kelulusan: " . $namaLengkap;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
