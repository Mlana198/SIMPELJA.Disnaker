<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPelatihan extends Model
{
    protected $fillable = [
        'pelatihans_id',
        'nama_dokumen',
        'jenis_dokumen',
        'file_path'
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
}
