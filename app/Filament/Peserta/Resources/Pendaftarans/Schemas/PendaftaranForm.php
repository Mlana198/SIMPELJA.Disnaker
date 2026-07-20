<?php

namespace App\Filament\Peserta\Resources\Pendaftarans\Schemas;

use App\Models\Pelatihan;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class PendaftaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // SECTION 1: DATA DIRI PESERTA (Otomatis Terisi dari Akun Login)
                Section::make('Informasi Data Diri Peserta')
                    ->description('Pastikan data akun Anda sudah sesuai sebelum melanjutkan pendaftaran.')
                    ->schema([

                        TextInput::make('buktiPendaftaran.nomor_registrasi')
                            ->label('Nomor Pendaftaran')
                            ->default(fn() => 'REG-' . time() . '-' . Auth::id())
                            ->readOnly()
                            ->dehydrated()
                            ->required(),

                        TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->default(fn() => Auth::user()->name)
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->default(fn() => Auth::user()->email)
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(3),

                // SECTION 2: PROGRAM PELATIHAN YANG DIIKUTI
                Section::make('Program Pelatihan')
                    ->schema([

                        Select::make('pelatihans_id')
                            ->label('Pilih Program Pelatihan')
                            ->options(function () {
                                return Pelatihan::where('status_periode', 'aktif')
                                    ->pluck('nama_pelatihan', 'id');
                            })
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->dehydrated()
                            ->placeholder('Pilih pelatihan yang ingin Anda ikuti...'),
                    ]),

                // SECTION 3: DOKUMEN PERSYARATAN (Menuju tabel berkas_pendaftaran)
                Section::make('Dokumen Lampiran')
                    ->description('Silakan unggah berkas KTP, Ijazah Terakhir, dan Pas Foto Anda di bawah ini.')
                    ->schema([
                        Repeater::make('berkasPendaftaran')
                            ->relationship('berkasPendaftaran')
                            ->label('Daftar Berkas')
                            ->schema([
                                Select::make('jenis_berkas')
                                    ->label('Jenis Berkas')
                                    ->options([
                                        'ktp' => 'Kartu Tanda Penduduk (KTP)',
                                        'ijazah' => 'Ijazah Terakhir',
                                        'pasFoto' => 'Pas Foto',
                                    ])
                                    ->required(),

                                FileUpload::make('file_path')
                                    ->label('Unggah Berkas (PDF/Gambar)')
                                    ->required()
                                    ->directory('pendaftaran/berkas')
                                    ->maxSize(2048),
                            ])
                            ->columns(2)
                            ->defaultItems(3)
                            ->addActionLabel('Tambah Berkas Pendukung Lainnya')
                    ])
            ]);
    }
}
