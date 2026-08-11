<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@shop2.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@shop2.com',
            'password' => 'password',
        ]);

        User::factory()->count(12)->create();

        $this->call([
            OrderSeeder::class,
        ]);
    }
}
