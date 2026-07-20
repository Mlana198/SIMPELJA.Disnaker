<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianInterview extends Model
{
    protected $table = 'penilaian_interviews';

    protected $fillable = [
        'jadwal_interview_id',
        'skor_minat',
        'skor_bakat',
        'catatan_kualitatif',
        'status_akhir'
    ];

    public function jadwalInterview()
    {
        return $this->belongsTo(JadwalInterview::class, 'jadwal_interview_id');
    }
}
