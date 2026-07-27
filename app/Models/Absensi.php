<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'id',
        'pelatihans_id',
        'user_id',
        'tanggal',
        'status_kehadiran'
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihans_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
