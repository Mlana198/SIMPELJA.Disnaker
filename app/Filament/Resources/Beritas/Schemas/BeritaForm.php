<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required(),
                Textarea::make('konten')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('foto_banner')
                    ->label('Gambar Berita')
                    ->image()
                    ->acceptedFileTypes(['image/png', 'image/jpeg'])
                    ->disk('public')
                    ->directory('berita')
                    ->preserveFilenames()
                    ->nullable()
                    ->imagePreviewHeight('150')
                    ->columnSpanFull()
                    ->required(false),
                DateTimePicker::make('tanggal_publish')
                    ->required(),
            ]);
    }
}
