<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed the application with sample orders.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();

        if ($customers->isEmpty()) {
            $customers = collect([User::factory()->create()]);
        }

        foreach ($customers->take(6) as $customer) {
            $itemCount = rand(1, 4);

            for ($i = 0; $i < $itemCount; $i++) {
                $orderItems = collect(range(1, rand(1, 3)))->map(function () {
                    return [
                        'product' => \App\Models\Product::inRandomOrder()->first(),
                        'quantity' => rand(1, 3),
                    ];
                });

                $subtotal = $orderItems->sum(fn ($item) => $item['product']->price * $item['quantity']);
                $tax = round($subtotal * 0.08, 2);
                $shipping = $subtotal >= 100 ? 0.00 : 5.99;
                $total = round($subtotal + $tax + $shipping, 2);

                $status = collect(Order::STATUSES)->random();

                $order = Order::create([
                    'user_id' => $customer->id,
                    'order_number' => 'ORD-'.strtoupper(uniqid()),
                    'status' => $status,
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'shipping' => $shipping,
                    'total' => $total,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => fake()->phoneNumber(),
                    'address' => fake()->streetAddress(),
                    'city' => fake()->city(),
                    'zip' => fake()->postcode(),
                    'payment_method' => collect(['cod', 'card'])->random(),
                    'notes' => rand(0, 1) ? 'Please leave at the front door.' : null,
                    'created_at' => fake()->dateTimeBetween('-6 months'),
                    'updated_at' => now(),
                ]);

                foreach ($orderItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product']->id,
                        'product_name' => $item['product']->name,
                        'price' => $item['product']->price,
                        'quantity' => $item['quantity'],
                        'total' => round($item['product']->price * $item['quantity'], 2),
                    ]);
                }
            }
        }
    }
}
