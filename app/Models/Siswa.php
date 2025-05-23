<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Siswa extends Model
{
    use Uuid;
    use HasFactory;
    protected $guarded = [];
    public function nilai()
    {
        
        return $this->hasMany(Nilai::class);
    }
    /**
     * Get the kelas that the siswa belongs to.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
