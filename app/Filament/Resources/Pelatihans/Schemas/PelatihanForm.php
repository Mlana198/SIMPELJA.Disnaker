<?php

namespace App\Filament\Resources\Pelatihans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PelatihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('foto')
                    ->label('Gambar Pelatihan')
                    ->image()
                    ->acceptedFileTypes(['image/png', 'image/jpeg'])
                    ->disk('public')
                    ->directory('dokumen-pelatihan')
                    ->preserveFilenames()
                    ->columnSpanFull()
                    ->maxSize(2048),
                TextInput::make('nama_pelatihan')
                    ->required(),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('kuota')
                    ->required()
                    ->numeric(),
                TextInput::make('angkatan')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_mulai')
                    ->required(),
                DatePicker::make('tanggal_selesai')
                    ->required(),
                Select::make('status_periode')
                    ->options(['aktif' => 'Aktif', 'non-aktif' => 'Non aktif', 'selesai' => 'Selesai'])
                    ->required(),
            ]);
    }
}
