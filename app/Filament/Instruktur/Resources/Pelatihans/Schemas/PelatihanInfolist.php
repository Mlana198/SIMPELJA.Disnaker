<?php

namespace App\Filament\Instruktur\Resources\Pelatihans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PelatihanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_pelatihan')
                    ->columnSpanFull()
                    ->color('primary'),

                Grid::make(3)
                    ->schema([
                        TextEntry::make('tanggal_mulai')
                            ->date(),
                        TextEntry::make('tanggal_selesai')
                            ->date(),
                        TextEntry::make('status_periode')
                            ->badge(),
                    ]),
            ]);
    }
}
