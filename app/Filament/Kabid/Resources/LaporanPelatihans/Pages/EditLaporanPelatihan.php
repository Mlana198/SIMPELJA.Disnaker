<?php

namespace App\Filament\Kabid\Resources\LaporanPelatihans\Pages;

use App\Filament\Kabid\Resources\LaporanPelatihans\LaporanPelatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanPelatihan extends EditRecord
{
    protected static string $resource = LaporanPelatihanResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['status_laporan_select'])) {
            $data['status_laporan'] = match ((int) $data['status_laporan']) {
                1 => 'disetujui',
                0 => 'direvisi',
                2 => 'ditolak',
                default => 'diajukan',
            };

            unset($data['status_laporan_select']);
        }

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
