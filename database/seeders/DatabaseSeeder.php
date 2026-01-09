<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\PeriodeMagang;
use App\Models\Laporan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        /*
        |----------------------------------------------------------
        | 1. ADMIN SISTEM
        |----------------------------------------------------------
        */
        $this->call(AdminSeeder::class);

        /*
        |----------------------------------------------------------
        | 2. MASTER DATA: FAKULTAS & PRODI
        |----------------------------------------------------------
        */
        Fakultas::factory()
            ->count(0)
            ->has(Prodi::factory()->count(4))
            ->create();

        /*
        |----------------------------------------------------------
        | 3. PERIODE MAGANG
        |----------------------------------------------------------
        */
        PeriodeMagang::factory()
            ->count(0)
            ->create();

        /*
        |----------------------------------------------------------
        | 4. LAPORAN MAGANG
        |----------------------------------------------------------
        */
        Laporan::factory()
            ->count(0)
            ->create();
    }
}
