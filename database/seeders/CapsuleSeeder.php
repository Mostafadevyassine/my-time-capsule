<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Capsule;
use App\Models\User;

class CapsuleSeeder extends Seeder
{
    public function run(): void
{
    $faker = \Faker\Factory::create('en_US'); // Ensure English
    $moods = ['happy', 'sad', 'Excited', 'Angry', 'Lonely', 'Tired', 'Bored', 'Calm'];

    $users = \App\Models\User::all();

    foreach ($users as $user) {
        \App\Models\Capsule::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);
    }
}
}