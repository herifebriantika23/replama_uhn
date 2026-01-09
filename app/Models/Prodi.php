<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fakultas;
use App\Models\User;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';

    protected $fillable = [
        'fakultas_id',
        'nama',
    ];

    /**
     * Relasi ke Fakultas
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    /**
     * Relasi ke User (mahasiswa dalam prodi)
     * OPTIONAL – hanya jika user punya kolom prodi_id
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

