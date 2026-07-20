<?php

namespace App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Pages;

use App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\PengajuanPendaftaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanPendaftaran extends EditRecord
{
    protected static string $resource = PengajuanPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
