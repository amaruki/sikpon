<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jurnal extends Model
{
    use HasFactory;

    protected $table = 'jurnal';

    protected $fillable = [
        'kode_jurnal',
        'tanggal',
        'guru_id',
        'mapel_id',
        'kelas_id',
        'materi_pokok',
        'kegiatan_pembelajaran',
        'evaluasi_pembelajaran',
        'santri_hadir',
        'santri_tidak_hadir',
        'jumlah_hadir',
        'jumlah_tidak_hadir',
        'catatan_khusus',
        'kendala_pembelajaran',
        'solusi_kendala',
        'status_jurnal',
        'pencapaian_target',
        'keterangan_pencapaian',
        'jam_mulai',
        'jam_selesai'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'santri_hadir' => 'array',
        'santri_tidak_hadir' => 'array',
        'jumlah_hadir' => 'integer',
        'jumlah_tidak_hadir' => 'integer'
    ];

    // Boot method untuk generate kode jurnal otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_jurnal)) {
                $model->kode_jurnal = $model->generateKodeJurnal();
            }
        });
    }

    /**
     * Generate kode jurnal otomatis
     * Format: JRN-YYYYMMDD-XXX
     */
    private function generateKodeJurnal()
    {
        $date = now()->format('Ymd');
        $prefix = "JRN-{$date}-";
        
        $lastJurnal = self::where('kode_jurnal', 'LIKE', $prefix . '%')
            ->orderBy('kode_jurnal', 'desc')
            ->first();

        if ($lastJurnal) {
            $lastNumber = intval(substr($lastJurnal->kode_jurnal, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $prefix . $newNumber;
    }

    /**
     * Relasi dengan User (Guru)
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    /**
     * Relasi dengan Mapel
     */
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    /**
     * Relasi dengan Kelas
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Accessor untuk mendapatkan durasi pembelajaran
     */
    public function getDurasiAttribute()
    {
        $mulai = \Carbon\Carbon::createFromFormat('H:i', $this->jam_mulai);
        $selesai = \Carbon\Carbon::createFromFormat('H:i', $this->jam_selesai);
        
        return $selesai->diffInMinutes($mulai) . ' menit';
    }

    /**
     * Accessor untuk status badge
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status_jurnal) {
            'draft' => '<span class="badge bg-warning">Draft</span>',
            'final' => '<span class="badge bg-success">Final</span>',
            default => '<span class="badge bg-secondary">Unknown</span>'
        };
    }

    /**
     * Accessor untuk pencapaian badge
     */
    public function getPencapaianBadgeAttribute()
    {
        return match($this->pencapaian_target) {
            'tercapai' => '<span class="badge bg-success">Tercapai</span>',
            'sebagian' => '<span class="badge bg-warning">Sebagian</span>',
            'tidak_tercapai' => '<span class="badge bg-danger">Tidak Tercapai</span>',
            default => '<span class="badge bg-secondary">Unknown</span>'
        };
    }

    /**
     * Scope untuk filter berdasarkan guru
     */
    public function scopeByGuru($query, $guruId)
    {
        return $query->where('guru_id', $guruId);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    /**
     * Scope untuk filter berdasarkan mata pelajaran
     */
    public function scopeByMapel($query, $mapelId)
    {
        return $query->where('mapel_id', $mapelId);
    }

    /**
     * Scope untuk filter berdasarkan kelas
     */
    public function scopeByKelas($query, $kelasId)
    {
        return $query->where('kelas_id', $kelasId);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_jurnal', $status);
    }

    /**
     * Method untuk mendapatkan santri yang hadir
     */
    public function getSantriHadirData()
    {
        if (!$this->santri_hadir) return collect();
        
        return User::whereIn('id', $this->santri_hadir)
            ->where('role', 'santri')
            ->get();
    }

    /**
     * Method untuk mendapatkan santri yang tidak hadir
     */
    public function getSantriTidakHadirData()
    {
        if (!$this->santri_tidak_hadir) return collect();
        
        $santriIds = array_keys($this->santri_tidak_hadir);
        
        return User::whereIn('id', $santriIds)
            ->where('role', 'santri')
            ->get()
            ->map(function ($santri) {
                $santri->keterangan_tidak_hadir = $this->santri_tidak_hadir[$santri->id] ?? '';
                return $santri;
            });
    }

    /**
     * Method untuk validasi akses berdasarkan role
     */
    public function canBeAccessedBy($user)
    {
        if ($user->role === 'admin') {
            return true;
        }
        
        if ($user->role === 'guru') {
            return $this->guru_id === $user->id;
        }
        
        if ($user->role === 'wali_murid') {
            // Wali murid hanya bisa akses jurnal anak mereka
            $anakIds = $user->anak()->pluck('id')->toArray();
            $santriDiJurnal = array_merge(
                $this->santri_hadir ?? [],
                array_keys($this->santri_tidak_hadir ?? [])
            );
            
            return !empty(array_intersect($anakIds, $santriDiJurnal));
        }
        
        return false;
    }
}