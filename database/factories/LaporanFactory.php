<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Prodi;
use App\Models\PeriodeMagang;
use App\Models\Laporan;

class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    public function definition(): array
    {
        // Ambil mahasiswa
        $user = User::where('role', 'user')->inRandomOrder()->first()
            ?? User::factory()->create(['role' => 'user']);

        // Ambil prodi (WAJIB ADA)
        $prodi = Prodi::inRandomOrder()->first()
            ?? Prodi::factory()->create();

        // Ambil periode magang
        $periode = PeriodeMagang::inRandomOrder()->first()
            ?? PeriodeMagang::factory()->create();

        return [
            'user_id' => $user->id,

            
            'prodi_id' => $prodi->id,

            'periode_magang_id' => $periode->id,

            'judul' => fake()->sentence(4),
            'file_pdf' => 'laporan/sample.pdf',

            'dosen_pembimbing' => fake()->name(),

            'status' => fake()->randomElement([
                'menunggu',
                'disetujui',
                'revisi',
            ]),

            'catatan' => fake()->optional(0.4)->sentence(),
        ];
    }
}

