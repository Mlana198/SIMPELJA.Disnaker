<?php

namespace App\Filament\Resources\Pendaftarans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PendaftaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([

                Section::make('Verifikasi Kelengkapan Berkas')
                    ->description('Periksa dokumen di bawah terlebih dahulu sebelum menentukan status kelulusan administrasi.')
                    ->schema([

                        TextInput::make('id')
                            ->label('ID Pendaftaran')
                            ->disabled(),

                        TextInput::make('tanggal_daftar')
                            ->label('Tanggal Pendaftaran')
                            ->disabled(),


                        Select::make('status_seleksi_administrasi')
                            ->label('Status Seleksi Administrasi')
                            ->options([
                                'pending' => 'Pending (Antrean)',
                                'lolos' => 'Lolos Seleksi Administrasi',
                                'tidak_lolos' => 'Ditolak (Berkas Tidak Sesuai)',
                            ])
                            ->required(),
                    ])->columns(3),


                Section::make('Profil & Biodata Pendaftar')
                    ->description('Data identitas pengguna yang mengajukan pendaftaran.')
                    ->schema([
                        TextInput::make('nama_peserta')
                            ->label('Nama Pengguna Akun')
                            ->formatStateUsing(fn($record) => $record?->user?->name ?? 'Tidak Ada Nama')
                            ->disabled(),

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->formatStateUsing(fn($record) => $record?->user?->email ?? 'Tidak Ada Email')
                            ->disabled(),
                    ])->columns(2),


                Section::make('Dokumen Persyaratan')
                    ->description('Daftar berkas yang diunggah oleh peserta dari database berkas_pendaftaran.')
                    ->schema([
                        Repeater::make('berkasPendaftaran')
                            ->relationship('berkasPendaftaran')
                            ->label('Berkas Peserta')
                            ->disabled()
                            ->schema([
                                TextInput::make('jenis_berkas')
                                    ->label('Jenis Dokumen')
                                    ->disabled(),

                                FileUpload::make('file_path')
                                    ->label('Berkas Dokumen')
                                    ->directory('pendaftaran/berkas')
                                    ->openable()
                                    ->downloadable()
                                    ->disabled(),
                            ])
                            ->columns(2)
                            ->dehydrated(false)
                    ]),
            ]);
    }
}
