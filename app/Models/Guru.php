<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Guru extends Authenticatable
{
    protected $fillable = [
        'nama',
        'gelar',
        'nip',
        'nuptk',
        'tempat_lahir',
        'tgl_lahir',
        'no_hp',
        'pendidikan',
        'alamat',
        'provinsi',
        'kab_kota',
        'kecamatan',
        'desa',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value != null) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function setProvinsiAttribute($value)
    {
        if ($value != null) {
            $this->attributes['provinsi'] = ucwords(strtolower($value));
        }
    }

    public function setKabKotaAttribute($value)
    {
        if ($value != null) {
            $this->attributes['kab_kota'] = ucwords(strtolower($value));
        }
    }

    public function setKecamatanAttribute($value)
    {
        if ($value != null) {
            $this->attributes['kecamatan'] = ucwords(strtolower($value));
        }
    }

    public function setDesaAttribute($value)
    {
        if ($value != null) {
            $this->attributes['desa'] = ucwords(strtolower($value));
        }
    }

    /**
     * The pengajars that belong to the MataPelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mapels(): BelongsToMany
    {
        return $this->belongsToMany(MataPelajaran::class, 'guru_pengajars', 'guru_id', 'mata_pelajaran_id');
    }

    /**
     * Get all of the pengajars for the Guru
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengajars(): HasMany
    {
        return $this->hasMany(GuruPengajar::class);
    }
}
