<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class ProfilPengguna extends Model
{
    protected $table = 'profil_pengguna';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'no_hp',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
