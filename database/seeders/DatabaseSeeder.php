<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meal;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed some meals
        Meal::create(['name' => 'Chin Chin', 'price' => 8.99]);
        Meal::create(['name' => 'Crispy Calamari', 'price' => 11.99]);
        Meal::create(['name' => 'Mozzarella Sticks', 'price' => 7.90]);
        Meal::create(['name' => 'Beef Burger Deluxe', 'price' => 16.90]);
        Meal::create(['name' => 'Grilled Salmon', 'price' => 22.99]);
        Meal::create(['name' => 'Creamy Mushroom Pasta', 'price' => 18.99]);
    }
}
