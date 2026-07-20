<?php

namespace App\Filament\Resources\LaporanPelatihans\Pages;

use App\Filament\Resources\LaporanPelatihans\LaporanPelatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanPelatihan extends EditRecord
{
    protected static string $resource = LaporanPelatihanResource::class;

    // Bersihkan fungsi mutateFormDataBeforeSave yang merusak status laporan!
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Biarkan data tersimpan apa adanya sesuai input draf form.
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
