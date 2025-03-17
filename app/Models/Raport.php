<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Rapot extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'siswa_id', 'kelas_id', 'tahun_id', 'semester',
        'jumlah_sakit', 'jumlah_izin', 'jumlah_alpa', 'catatan_wali_kelas', 'is_published'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }

    public function details()
    {
        return $this->hasMany(RapotDetail::class);
    }
}