<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (isset($model->nilai_teori) && isset($model->nilai_praktek)) {
                $model->nilai_akhir = ($model->nilai_teori + $model->nilai_praktek) / 2;
            }
        });

        static::updating(function ($model) {
            if (isset($model->nilai_teori) && isset($model->nilai_praktek)) {
                $model->nilai_akhir = ($model->nilai_teori + $model->nilai_praktek) / 2;
            }
        });
    }

    protected $fillable = [
        'pelatihans_id',
        'user_id',
        'nilai_teori',
        'nilai_praktek',
        'nilai_akhir',
        'catatan_instruktur',
        'instruktur_id'
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihans_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id');
    }
}
