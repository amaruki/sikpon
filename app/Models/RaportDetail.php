<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapotDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rapot_id', 'mapel_id', 'nilai_pengetahuan', 'nilai_keterampilan',
        'deskripsi_pengetahuan', 'deskripsi_keterampilan'
    ];

    public function rapot()
    {
        return $this->belongsTo(Rapot::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}