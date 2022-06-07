<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik_id',
        'kelas_id',
        'kode_mapel',
        'nama_mapel',
        'total_jam',
        'start',
        'end',
    ];

    /**
     * Get the tahun_akademik that owns the MataPelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahun_akademik(): BelongsTo
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }

    /**
     * The pengajars that belong to the MataPelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pengajars(): BelongsToMany
    {
        return $this->belongsToMany(Guru::class, 'guru_pengajars', 'mata_pelajaran_id', 'guru_id');
    }

    /**
     * Get the kelas that owns the MataPelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
