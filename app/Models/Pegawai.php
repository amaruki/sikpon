<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pegawai extends Model
{
    use Uuid;
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user associated with the pegawai.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the kelas that are managed by this pegawai.
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    /**
     * Get all jadwals for this pegawai.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    /**
     * Get all jurnals created by this pegawai.
     */
    public function jurnals()
    {
        return $this->hasMany(Jurnal::class, 'guru_id');
    }
}
