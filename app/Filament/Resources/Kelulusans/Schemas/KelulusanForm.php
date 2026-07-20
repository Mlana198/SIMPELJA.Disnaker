<?php

namespace App\Filament\Resources\Kelulusans\Schemas;


use App\Models\Pendaftaran;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KelulusanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Select::make('pelatihans_id')
                        ->relationship('pelatihan', 'nama_pelatihan')
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn($set) => $set('user_id', null)),

                    Select::make('user_id')
                        ->label('Nama Peserta')
                        ->options(function ($get) {
                            $pelatihanId = $get('pelatihans_id');
                            if (!$pelatihanId) return [];

                            return Pendaftaran::where('pelatihans_id', $pelatihanId)
                                ->get()
                                ->pluck('user.profil.nama_lengkap', 'user_id');
                        })
                        ->required()
                        ->searchable(),

                    Select::make('status_kelulusan')
                        ->options([
                            'lulus' => 'Lulus Pelatihan',
                            'tidak_lulus' => 'Tidak Lulus',
                        ])
                        ->required()
                        ->disabled(function ($get) {
                            $pelatihanId = $get('pelatihans_id');
                            if (!$pelatihanId) return true;

                            return false;
                        }),
                ])
            ]);
    }
}
