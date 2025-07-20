<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use App\Models\User;  // Import User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users using the factory
        User::factory()->count(15)->create();
    }
}