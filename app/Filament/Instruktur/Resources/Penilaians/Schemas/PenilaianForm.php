<?php

namespace App\Filament\Instruktur\Resources\Penilaians\Schemas;

use App\Models\Pendaftaran;
use App\Models\ProfilPengguna;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class PenilaianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pelatihans_id')
                    ->label('Nama Pelatihan')
                    ->relationship('pelatihan', 'nama_pelatihan', function ($query) {
                        return $query->whereHas('jadwalInterviews', fn($q) => $q->where('interviewer_user_id', Auth::id()));
                    })
                    ->required()
                    ->live(),

                Select::make('user_id')
                    ->label('Nama Peserta')
                    ->options(function ($get) {
                        $pelatihanId = $get('pelatihans_id');

                        if (! $pelatihanId) {
                            return [];
                        }

                        $pesertaIds = Pendaftaran::where('pelatihans_id', $pelatihanId)
                            ->pluck('user_id')
                            ->toArray();

                        return ProfilPengguna::whereIn('user_id', $pesertaIds)
                            ->pluck('nama_lengkap', 'user_id')
                            ->toArray();
                    })
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live(),

                TextInput::make('nilai_teori')
                    ->label('Nilai Teori')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $get, $set) {
                        $praktek = $get('nilai_praktek') ?? 0;
                        $set('nilai_akhir', ((float)$state + (float)$praktek) / 2);
                    }),

                TextInput::make('nilai_praktek')
                    ->label('Nilai Praktek')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $get, $set) {
                        $teori = $get('nilai_teori') ?? 0;
                        $set('nilai_akhir', ((float)$teori + (float)$state) / 2);
                    }),

                TextInput::make('nilai_akhir')
                    ->label('Nilai Akhir (Otomatis)')
                    ->numeric()
                    ->readOnly()
                    ->required()
                    ->afterStateHydrated(function ($state, $get, $set) {
                        $teori = $get('nilai_teori') ?? 0;
                        $praktek = $get('nilai_praktek') ?? 0;
                        $set('nilai_akhir', ((float)$teori + (float)$praktek) / 2);
                    }),

                Textarea::make('catatan_instruktur')
                    ->columnSpanFull(),
            ]);
    }
}
