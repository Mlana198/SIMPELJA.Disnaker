<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'pelatihans_id',
        'tanggal_daftar',
        'status_seleksi_administrasi',
        'status_kelulusan',
        'is_sent_to_koordinator',
        'catatan_keputusan',
        'is_notified',
    ];

    protected static function booted()
    {
        static::creating(function ($pendaftaran) {

            $pendaftaran->tanggal_daftar = now();
        });

        static::saved(function ($pendaftaran) {
            if (request()->has('data.buktiPendaftaran')) {
                $buktiData = request()->input('data.buktiPendaftaran');

                $pendaftaran->buktiPendaftaran()->updateOrCreate(
                    ['pendaftaran_id' => $pendaftaran->id],
                    [
                        'nomor_registrasi' => $buktiData['nomor_registrasi'] ?? 'REG-' . time() . '-' . Auth::id(),
                        'tanggal_issued' => now(),
                    ]
                );
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihans_id', 'id');
    }

    public function berkasPendaftaran()
    {
        return $this->hasMany(BerkasPendaftaran::class, 'pendaftaran_id');
    }

    public function jadwalInterview()
    {
        return $this->hasOne(JadwalInterview::class, 'pendaftaran_id');
    }

    public function buktiPendaftaran()
    {
        return $this->hasOne(BuktiPendaftaran::class, 'pendaftaran_id');
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class, 'pendaftaran_id');
    }
}
