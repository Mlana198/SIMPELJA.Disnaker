<?php

namespace App\Filament\Resources\Penilaians\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PenilaianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pelatihans_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('nilai_teori')
                    ->numeric(),
                TextInput::make('nilai_praktek')
                    ->numeric(),
                TextInput::make('nilai_akhir')
                    ->numeric(),
                Textarea::make('catatan_instruktur')
                    ->columnSpanFull(),
                TextInput::make('instruktur_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
