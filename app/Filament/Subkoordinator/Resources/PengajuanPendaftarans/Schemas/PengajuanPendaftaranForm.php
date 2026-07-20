<?php

namespace App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PengajuanPendaftaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pendaftaran Peserta')
                    ->description('Ringkasan data berkas pendaftar yang dikirim oleh Admin.')
                    ->columns(2)
                    ->schema([
                        Placeholder::make('buktiPendaftaran.nomor_registrasi') // KOREKSI: Panggil relasi yang benar
                            ->label('No. Pendaftaran')
                            ->content(fn($record) => $record?->buktiPendaftaran?->nomor_registrasi ?? '-'),

                        Placeholder::make('nama_peserta')
                            ->label('Nama Lengkap')
                            ->content(fn($record) => $record?->user?->profil?->nama_lengkap ?? 'Tidak ada data'),

                        Placeholder::make('nama_pelatihan')
                            ->label('Program Pelatihan')
                            ->content(fn($record) => $record?->pelatihan?->nama_pelatihan ?? '-'),

                        Placeholder::make('status_seleksi_administrasi')
                            ->label('Status Berkas (Admin)')
                            ->content(fn($record) => strtoupper($record?->status_seleksi_administrasi ?? '-')),
                    ]),

                Section::make('Keputusan Subkoordinator')
                    ->description('Tentukan tindakan atau ubah status kelulusan final pendaftar ini.')
                    ->schema([
                        // ⚡ FITUR UTAMA: Dropdown untuk merubah alur catatan_keputusan
                        Select::make('catatan_keputusan')
                            ->label('Status Dokumen / Keputusan')
                            ->options([
                                'diajukan_ke_subkor' => 'Menunggu Persetujuan',
                                'dijadwalkan_interview' => 'Diberi Jadwal Interview',
                                'pendaftaran_diterima' => 'Disetujui (Lolos Final)',
                                'ditolak_subkor' => 'Ditolak',
                            ])
                            ->required()
                            ->native(false), // Tampilan dropdown modern khas Filament
                    ]),
            ]);
    }
}
