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
    protected static ?string $password;

    protected $model = \App\Models\User::class;

    public function definition(): array
{
    return [
        'name' => $this->faker->name(),
        'email' => $this->faker->safeEmail(),
        'password' => bcrypt('password'), // or use Hash::make()
    ];
}

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}