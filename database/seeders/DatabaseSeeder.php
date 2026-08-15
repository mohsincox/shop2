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

        $users = [
            ['name' => 'Admin User', 'email' => 'admin@shop2.com', 'role' => 'admin'],
            ['name' => 'John Doe', 'email' => 'john@shop2.com', 'role' => 'customer'],
            ['name' => 'Emma Wilson', 'email' => 'customer1@shop2.com', 'role' => 'customer'],
            ['name' => 'Liam Brown', 'email' => 'customer2@shop2.com', 'role' => 'customer'],
            ['name' => 'Olivia Garcia', 'email' => 'customer3@shop2.com', 'role' => 'customer'],
            ['name' => 'Noah Martinez', 'email' => 'customer4@shop2.com', 'role' => 'customer'],
            ['name' => 'Ava Rodriguez', 'email' => 'customer5@shop2.com', 'role' => 'customer'],
            ['name' => 'Ethan Davis', 'email' => 'customer6@shop2.com', 'role' => 'customer'],
            ['name' => 'Sophia Lee', 'email' => 'customer7@shop2.com', 'role' => 'customer'],
            ['name' => 'Mason Walker', 'email' => 'customer8@shop2.com', 'role' => 'customer'],
            ['name' => 'Isabella Hall', 'email' => 'customer9@shop2.com', 'role' => 'customer'],
            ['name' => 'James Young', 'email' => 'customer10@shop2.com', 'role' => 'customer'],
            ['name' => 'Mia King', 'email' => 'customer11@shop2.com', 'role' => 'customer'],
            ['name' => 'Lucas Wright', 'email' => 'customer12@shop2.com', 'role' => 'customer'],
        ];

        foreach ($users as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => 'password',
                    'role' => $data['role'],
                ]
            );
        }

        $this->call([
            OrderSeeder::class,
        ]);
    }
}
