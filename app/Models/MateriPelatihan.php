<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriPelatihan extends Model
{
    protected $table = 'materi_pelatihan';

    protected $fillable = [
        'pelatihans_id',
        'judul_materi',
        'deskripsi',
        'file_materi_path',
        'uploaded_by'
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihans_id');
    }
}
