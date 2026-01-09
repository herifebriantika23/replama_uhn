<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'user_id',
        'prodi_id',
        'periode_magang_id',
        'dosen_pembimbing',
        'judul',
        'file_pdf',
        'status',
        'catatan',
    ];

    /**
     * Relasi ke User (Mahasiswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Prodi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Relasi ke Periode Magang
     */
    public function periodeMagang()
    {
        return $this->belongsTo(PeriodeMagang::class);
    }

    /**
     * Helper status
     */
    public function isMenunggu()
    {
        return $this->status === 'menunggu';
    }

    public function isDisetujui()
    {
        return $this->status === 'disetujui';
    }

    public function isRevisi()
    {
        return $this->status === 'revisi';
    }
}
