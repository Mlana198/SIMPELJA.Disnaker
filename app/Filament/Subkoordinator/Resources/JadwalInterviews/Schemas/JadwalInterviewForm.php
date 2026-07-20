<?php

namespace App\Filament\Subkoordinator\Resources\JadwalInterviews\Schemas;

use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JadwalInterviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Calon Peserta')
                    ->columns(2)
                    ->schema([
                        Placeholder::make('buktiPendaftaran.nomor_registrasi')
                            ->label('Nomor Registrasi')
                            ->content(fn($record) => $record?->buktiPendaftaran?->nomor_registrasi ?? '-'),

                        Placeholder::make('user.profil.nama_lengkap')
                            ->label('Nama Calon Peserta')
                            ->content(fn($record) => $record?->user?->profil?->nama_lengkap ?? $record?->user?->name ?? '-'),

                        Placeholder::make('user.nomor_identitas')
                            ->label('Nomor Identitas (KTP)')
                            ->content(fn($record) => $record?->user?->nomor_identitas ?? '-'),

                        Placeholder::make('pelatihan.nama_pelatihan')
                            ->label('Program Pelatihan')
                            ->content(fn($record) => $record?->pelatihan?->nama_pelatihan ?? '-'),
                    ]),

                Section::make('Detail Jadwal & Pelaksanaan Interview')
                    ->relationship('jadwalInterview')
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('waktu_interview')
                            ->label('Tanggal & Waktu Interview')
                            ->required()
                            ->native(false)
                            ->displayFormat('d M Y - H:i'),

                        TextInput::make('tempat_atau_link')
                            ->label('Tempat / Link Interview')
                            ->required()
                            ->placeholder('Masukkan lokasi fisik atau URL Zoom/Google Meet')
                            ->maxLength(255),

                        Select::make('interviewer_user_id')
                            ->label('Instruktur Penguji')
                            ->required()
                            ->options(function () {
                                return User::where('role', 'instruktur')
                                    ->get()
                                    ->pluck('profil.nama_lengkap', 'id');
                            })
                            ->searchable()
                            ->preload(),
                    ]),
            ]);
    }
}
