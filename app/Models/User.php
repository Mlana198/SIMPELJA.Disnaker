<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[Fillable(['nomor_identitas', 'email', 'email_verified_at', 'password', 'role', 'avatar_url'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements HasAvatar, MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, MustVerifyEmailTrait;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $id = $panel->getId();
        return match ($this->role) {
            'admin'           => $id === 'admin',
            'kabid'           => $id === 'kabid',
            'subkoordinator'  => $id === 'subkoordinator',
            'instruktur'      => $id === 'instruktur',
            'peserta'         => $id === 'peserta',
            default           => false,
        };
    }

    /**
     * Relasi ke ProfilPengguna (Satu User memiliki Satu Profil Sekunder)
     */
    public function profil(): HasOne
    {
        return $this->hasOne(ProfilPengguna::class, 'user_id');
    }

    public function getNameAttribute(): string
    {
        return $this->profil ? $this->profil->nama_lengkap : 'Pengguna';
    }


    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function pendaftarans()
    {
        return $this->hasMany(
            Pendaftaran::class,
            'user_id',
            'id'
        );
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'user_id');
    }
}
