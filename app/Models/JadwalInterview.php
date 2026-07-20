<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalInterview extends Model
{
    protected $table = 'jadwal_interview';

    protected $fillable = [
        'pendaftaran_id',
        'interviewer_user_id',
        'waktu_interview',
        'tempat_atau_link'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_user_id');
    }

    public function penilaian()
    {
        return $this->hasOne(PenilaianInterview::class, 'jadwal_interview_id');
    }

    public function penilaianInterview()
    {
        return $this->hasOne(PenilaianInterview::class, 'jadwal_interview_id');
    }
}
