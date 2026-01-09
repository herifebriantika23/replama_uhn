<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@kampus.ac.id'],
            [
                'name'     => 'Admin Sistem',
                'password' => bcrypt('admin123'),
                'role'     => 'admin',
                'nim'      => null,
            ]
        );
    }
}
