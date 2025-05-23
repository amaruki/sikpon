<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasis extends Model
{
    use HasFactory;
    protected $guarded = [];


    // Add relationship to Kelas model
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}