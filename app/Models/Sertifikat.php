<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';

    protected $fillable = [
        'pendaftaran_id',
        'nomor_sertifikat',
        'nomor_sk_kadis',
        'tanggal_sk_kadis',
        'durasi_pelatihan',
        'ditandatangani_oleh_nama',
        'ditandatangani_oleh_nip',
        'file_sertifikat_path',
        'tanggal_terbit'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}
