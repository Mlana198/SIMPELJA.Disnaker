<?php

namespace App\Filament\Peserta\Resources\Pendaftarans\Pages;

use App\Filament\Peserta\Resources\Pendaftarans\PendaftaranResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePendaftaran extends CreateRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        $data['status_seleksi_administrasi'] = 'pending';
        $data['tanggal_daftar'] = now()->format('Y-m-d');

        if (!isset($data['pelatihans_id'])) {
            $data['pelatihans_id'] = request()->input('mountedActionsData.0.pelatihans_id')
                ?? request()->input('data.pelatihans_id');
        }

        return $data;
    }

    /**
     * Pemicu Otomatis Tepat Setelah Data Pendaftaran Berhasil Disimpan
     */
    protected function afterCreate(): void
    {
        // 1. Ambil instance object Pendaftaran yang baru saja selesai di-insert
        $pendaftaran = $this->record;

        // 2. Pasang generator string unik langsung di sisi server (Bypass Request)
        $nomorRegistrasiResmi = 'REG-' . time() . '-' . Auth::id();

        // 3. Eksekusi query insert ke tabel bukti_pendaftaran secara presisi
        $pendaftaran->buktiPendaftaran()->create([
            'nomor_registrasi' => $nomorRegistrasiResmi,
            'tanggal_issued'   => now(),
        ]);
    }

    // Mengalihkan kembali peserta ke halaman tabel setelah sukses mendaftar
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            $this->getResource()::getUrl('index') => $this->getResource()::getPluralModelLabel(),
            'Pendaftaran Baru'
        ];
    }
}
