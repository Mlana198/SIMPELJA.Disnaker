<?php

namespace App\Filament\Peserta\Resources\Kelulusans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KelulusanForm
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
                Select::make('status_kelulusan')
                    ->options(['lulus' => 'Lulus', 'tidak_lulus' => 'Tidak lulus', 'pending' => 'Pending'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
