<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPendaftaran extends Model
{
    protected $table = 'bukti_pendaftaran';

    protected $fillable = [
        'pendaftaran_id',
        'nomor_registrasi',
        'file_bukti_path',
        'tanggal_issued'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}
