<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeMagang extends Model
{
    use HasFactory;

    // Laravel otomatis pakai tabel "periode_magangs"

    protected $fillable = [
        'nama',
        'mulai',
        'selesai',
        'aktif',
    ];

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}




