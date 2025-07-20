<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Use both seeders (cleaner and clearer)
        $this->call([
            UserSeeder::class,
            CapsuleSeeder::class,
        ]);
    }
}
