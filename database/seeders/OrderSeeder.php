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
            return;
        }

        $names = ['Alice Johnson', 'Ben Carter', 'Chloe Nguyen', 'David Kim', 'Emma Wilson', 'Liam Brown'];
        $streets = ['42 Maple Street', '17 Oak Avenue', '88 Cedar Lane', '5 Pine Road', '120 Birch Blvd', '33 Willow Court'];
        $cities = ['Springfield', 'Riverside', 'Brookfield', 'Fairview', 'Lakeside', 'Greenfield'];
        $zips = ['12345', '67890', '34567', '89012', '45678', '90123'];
        $phones = ['555-0101', '555-0102', '555-0103', '555-0104', '555-0105', '555-0106'];

        foreach ($customers->take(6) as $index => $customer) {
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
                    'phone' => $phones[$index % count($phones)],
                    'address' => $streets[$index % count($streets)],
                    'city' => $cities[$index % count($cities)],
                    'zip' => $zips[$index % count($zips)],
                    'payment_method' => collect(['cod', 'card'])->random(),
                    'notes' => rand(0, 1) ? 'Please leave at the front door.' : null,
                    'created_at' => now()->subDays(rand(1, 180)),
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
