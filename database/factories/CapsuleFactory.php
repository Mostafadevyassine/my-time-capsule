<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capsule>
 */
class CapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;    
        $moods = ['happy', 'sad', 'Excited', 'Angry', 'Lonely', 'Tired', 'Bored', 'Calm'];
    
        return [
            'user_id' => $faker->numberBetween(1, 10),
    
            'message' => $faker->realText(50), // ✅ Use realText instead of sentence
    
            'reveal_date' => $faker->dateTimeBetween('now', '+1 year'),
    
            'country' => $faker->country(),
    
            'mood' => $faker->randomElement($moods),
    
            'privacy' => $faker->randomElement(['public', 'private']),
    
            'is_surprise' => $faker->boolean(20),
    
            'is_revealed' => $faker->boolean(),
    
            'file_name' => $faker->optional()->imageUrl(),
    
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}