<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's products.
     */
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $products = [
            [
                'category' => 'footwear',
                'name' => 'Aurora Running Sneakers',
                'description' => 'Lightweight performance sneakers with responsive cushioning, breathable mesh upper and a durable rubber outsole. Perfect for daily runs and casual wear.',
                'price' => 129.99,
                'stock' => 45,
                'featured' => true,
            ],
            [
                'category' => 'footwear',
                'name' => 'Urban Leather Boots',
                'description' => 'Handcrafted full-grain leather boots with a classic silhouette, comfortable padded collar and slip-resistant sole. Built to last for years.',
                'price' => 189.99,
                'stock' => 20,
                'featured' => true,
            ],
            [
                'category' => 'footwear',
                'name' => 'Cloud Walker Sandals',
                'description' => 'Comfortable everyday sandals with cushioned footbed, adjustable straps and anti-slip outsole. Ideal for warm weather and beach days.',
                'price' => 49.99,
                'stock' => 60,
                'featured' => false,
            ],
            [
                'category' => 'electronics',
                'name' => 'Pulse Wireless Headphones',
                'description' => 'Premium over-ear wireless headphones with active noise cancellation, 40-hour battery life and immersive studio-quality sound.',
                'price' => 249.99,
                'stock' => 25,
                'featured' => true,
            ],
            [
                'category' => 'electronics',
                'name' => 'Nova Smart Watch Series 5',
                'description' => 'Track your fitness, heart rate and sleep with this sleek smart watch. Features a vivid AMOLED display, GPS and 7-day battery life.',
                'price' => 299.99,
                'stock' => 15,
                'featured' => true,
            ],
            [
                'category' => 'electronics',
                'name' => 'Volt Portable Power Bank 20000mAh',
                'description' => 'High-capacity power bank with dual USB output, fast-charging support and LED indicator. Keep your devices powered all day.',
                'price' => 39.99,
                'stock' => 80,
                'featured' => false,
            ],
            [
                'category' => 'electronics',
                'name' => 'Echo Bluetooth Speaker',
                'description' => 'Compact portable speaker with 360° surround sound, deep bass and IPX7 waterproof rating. Take your music anywhere.',
                'price' => 79.99,
                'stock' => 55,
                'featured' => false,
            ],
            [
                'category' => 'fashion',
                'name' => 'Classic Denim Jacket',
                'description' => 'Timeless medium-wash denim jacket with button front, chest pockets and a comfortable relaxed fit. A wardrobe essential.',
                'price' => 89.99,
                'stock' => 40,
                'featured' => true,
            ],
            [
                'category' => 'fashion',
                'name' => 'Merino Wool Crew Sweater',
                'description' => 'Soft, breathable merino wool sweater that keeps you warm in winter and cool in spring. Naturally odor-resistant and machine washable.',
                'price' => 109.99,
                'stock' => 35,
                'featured' => false,
            ],
            [
                'category' => 'fashion',
                'name' => 'Everyday Cotton T-Shirt Pack',
                'description' => 'Pack of 3 premium combed-cotton tees with a soft hand-feel, classic crew neck and a fit that stays sharp wash after wash.',
                'price' => 34.99,
                'stock' => 120,
                'featured' => false,
            ],
            [
                'category' => 'beauty',
                'name' => 'Glow Vitamin C Serum',
                'description' => 'Brightening facial serum with 15% vitamin C, hyaluronic acid and vitamin E. Evens skin tone and boosts radiance.',
                'price' => 42.99,
                'stock' => 70,
                'featured' => true,
            ],
            [
                'category' => 'beauty',
                'name' => 'Hydra Facial Moisturizer',
                'description' => 'Lightweight daily moisturizer that locks in hydration for 72 hours. Enriched with ceramides and hyaluronic acid.',
                'price' => 32.99,
                'stock' => 65,
                'featured' => false,
            ],
            [
                'category' => 'beauty',
                'name' => 'Rose Quartz Facial Roller',
                'description' => 'Rejuvenate your skin with this natural rose quartz roller. Helps reduce puffiness and enhance product absorption.',
                'price' => 24.99,
                'stock' => 90,
                'featured' => false,
            ],
            [
                'category' => 'home-living',
                'name' => 'Scandinavian Ceramic Vase Set',
                'description' => 'Set of 3 minimalist ceramic vases in earthy tones. A beautiful addition to any shelf, table or windowsill.',
                'price' => 59.99,
                'stock' => 30,
                'featured' => false,
            ],
            [
                'category' => 'home-living',
                'name' => 'Soft Cotton Throw Blanket',
                'description' => 'Ultra-soft 100% cotton throw blanket with a subtle knit texture. Perfect for cozying up on the sofa or bed.',
                'price' => 49.99,
                'stock' => 50,
                'featured' => true,
            ],
            [
                'category' => 'home-living',
                'name' => 'Aroma Essential Oil Diffuser',
                'description' => 'Ultrasonic aromatherapy diffuser with soft LED lighting, auto shut-off and a large 300ml water tank. Relax and unwind.',
                'price' => 36.99,
                'stock' => 75,
                'featured' => false,
            ],
            [
                'category' => 'accessories',
                'name' => 'Classic Minimalist Watch',
                'description' => 'Elegant minimalist watch with a genuine leather strap, Japanese quartz movement and scratch-resistant mineral glass.',
                'price' => 119.99,
                'stock' => 38,
                'featured' => true,
            ],
            [
                'category' => 'accessories',
                'name' => 'Vintage Polarized Sunglasses',
                'description' => 'Retro-style polarized sunglasses with UV400 protection, durable acetate frame and premium hinge construction.',
                'price' => 69.99,
                'stock' => 48,
                'featured' => false,
            ],
            [
                'category' => 'accessories',
                'name' => 'Everyday Canvas Backpack',
                'description' => 'Spacious waterproof canvas backpack with a padded 15" laptop sleeve, multiple pockets and a sleek modern design.',
                'price' => 79.99,
                'stock' => 42,
                'featured' => false,
            ],
            [
                'category' => 'footwear',
                'name' => 'Trail Hiking Boots',
                'description' => 'Waterproof hiking boots with rugged grip, ankle support and a breathable lining. Ready for any adventure.',
                'price' => 159.99,
                'stock' => 18,
                'featured' => false,
            ],
            [
                'category' => 'electronics',
                'name' => 'Lumen LED Desk Lamp',
                'description' => 'Eye-caring LED desk lamp with adjustable brightness and color temperature, USB charging port and touch controls.',
                'price' => 54.99,
                'stock' => 0,
                'featured' => false,
            ],
            [
                'category' => 'beauty',
                'name' => 'Botanic Hair Repair Oil',
                'description' => 'Nourishing hair oil with argan and jojoba extracts. Repairs split ends, tames frizz and adds a healthy shine.',
                'price' => 28.99,
                'stock' => 66,
                'featured' => false,
            ],
            [
                'category' => 'home-living',
                'name' => 'Nordic Table Lamp',
                'description' => 'Modern Nordic-style table lamp with a linen shade and warm glow. Creates a cozy ambiance in any room.',
                'price' => 64.99,
                'stock' => 28,
                'featured' => true,
            ],
            [
                'category' => 'accessories',
                'name' => 'Premium Leather Wallet',
                'description' => 'Slim full-grain leather wallet with 6 card slots, RFID-blocking lining and a compact, elegant profile.',
                'price' => 44.99,
                'stock' => 58,
                'featured' => false,
            ],
        ];

        foreach ($products as $data) {
            $categoryId = $categories[$data['category']];

            Product::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'category_id' => $categoryId,
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'stock' => $data['stock'],
                    'featured' => $data['featured'],
                ]
            );
        }
    }
}
