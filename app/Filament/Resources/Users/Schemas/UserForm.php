<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make()
                    ->tabs([

                        // TAB 1: Kredensial Akses Akun
                        Tabs\Tab::make('Informasi Akun')
                            ->schema([
                                TextInput::make('nomor_identitas')
                                    ->label('Nomor Identitas (NIP/NIK)')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                Select::make('role')
                                    ->label('Hak Akses / Role')
                                    ->options([
                                        'subkoordinator' => 'Subkoordinator',
                                        'instruktur' => 'Instruktur / Tim Penguji',
                                        'kabid' => 'Kepala Bidang (Kabid)',
                                    ])
                                    ->required(),

                                TextInput::make('password')
                                    ->password()
                                    ->maxLength(255)
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                    ->dehydrated(fn($state) => filled($state))
                                    ->required(fn(string $context): bool => $context === 'create'),
                            ])->columns(2),

                        // TAB 2: Profil Biodata (Hanya Menampilkan Saja / Read-Only)
                        Tabs\Tab::make('Profil Pemilik Akun')
                            ->schema([
                                TextInput::make('profil.nama_lengkap')
                                    ->label('Nama Lengkap (Dari Tabel Profil)')
                                    ->placeholder('Pengguna belum melengkapi biodata')
                                    ->disabled(),

                                TextInput::make('profil.no_hp')
                                    ->label('Nomor Telepon')
                                    ->disabled(),
                            ])->columns(2),

                    ])->columnSpanFull()
            ]);
    }
}
