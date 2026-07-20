<?php

namespace App\Filament\Instruktur\Resources\Materis\Schemas;


use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class MateriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Materi & Pelatihan')
                    ->schema([
                        Select::make('pelatihans_id')
                            ->label('Nama Pelatihan')
                            ->relationship('pelatihan', 'nama_pelatihan', function ($query) {
                                return $query->whereHas('pendaftarans.jadwalInterview', function ($q) {
                                    $q->where('interviewer_user_id', Auth::id());
                                });
                            })
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('judul_materi')
                            ->label('Judul Materi / Modul')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi Materi')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('File atau Dokumen Media')
                    ->schema([
                        FileUpload::make('file_materi_path')
                            ->label('Unggah Berkas (Modul / Gambar / Video)')
                            ->disk('public')
                            ->directory('materi-pelatihan')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'image/*',
                                'video/mp4',
                                'video/mkv'
                            ])
                            ->maxSize(51200)
                            ->downloadable()
                            ->openable(),

                        TextInput::make('link_video')
                            ->label('Link Video Eksternal (Opsional)')
                            ->placeholder('https://youtube.com/... atau https://drive.google.com/...')
                            ->url(),
                    ])->columns(2),
            ]);
    }
}
