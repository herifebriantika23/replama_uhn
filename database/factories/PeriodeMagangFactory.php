<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PeriodeMagang>
 */
class PeriodeMagangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama'   => 'Magang ' . fake()->year(),
            'mulai'  => now()->subMonths(2),
            'selesai'=> now()->addMonths(2),
            'aktif'  => true,
        ];
    }
}

