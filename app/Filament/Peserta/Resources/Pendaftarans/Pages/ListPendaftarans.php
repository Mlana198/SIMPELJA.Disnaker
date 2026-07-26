<?php

namespace App\Filament\Peserta\Resources\Pendaftarans\Pages;

use App\Filament\Peserta\Resources\Pendaftarans\PendaftaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPendaftarans extends ListRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Daftar Pelatihan')
                ->icon('heroicon-o-plus'),
        ];
    }
}
