<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Password statis untuk factory
     */
    protected static ?string $password;

    /**
     * Default state (MAHASISWA)
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),

            // ===== DEFAULT ROLE =====
            'role' => 'user',

            // ===== MAHASISWA =====
            'nim'  => fake()->numerify('2021####'),
        ];
    }

    /**
     * State ADMIN (tanpa NIM)
     */
    public function admin(): static
    {
        return $this->state(fn () => [
            'role' => 'admin',
            'nim'  => null,
        ]);
    }

    /**
     * Email belum diverifikasi
     */
    public function unverified(): static
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }
}

