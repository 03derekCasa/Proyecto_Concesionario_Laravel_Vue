<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\VehicleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Demo user
        User::factory()->create([
            'name' => 'derek',
            'email' => 'derek@example.com',
        ]);

        // Vehicles demo data
        $this->call([
            VehicleSeeder::class,
        ]);
    }
}
