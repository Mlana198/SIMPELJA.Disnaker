<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = 'pelatihans';

    protected $fillable = [
        'nama_pelatihan',
        'deskripsi',
        'kuota',
        'angkatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_periode',
        'foto',
        'status_laporan',
    ];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'pelatihans_id');
    }

    public function dokumenPelatihans()
    {
        return $this->hasMany(DokumenPelatihan::class, 'pelatihans_id');
    }

    public function absensis()
    {

        return $this->hasMany(Absensi::class, 'pelatihans_id');
    }

    public function jadwalInterviews()
    {
        return $this->hasManyThrough(
            JadwalInterview::class,
            Pendaftaran::class,
            'pelatihans_id',
            'pendaftaran_id',
            'id',
            'id'
        );
    }
}
