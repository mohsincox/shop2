<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's categories.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Footwear', 'slug' => 'footwear', 'description' => 'Sneakers, boots and shoes for every occasion.'],
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'The latest gadgets, accessories and smart devices.'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Trendy apparel and accessories for men and women.'],
            ['name' => 'Beauty', 'slug' => 'beauty', 'description' => 'Skincare, makeup and personal care essentials.'],
            ['name' => 'Home & Living', 'slug' => 'home-living', 'description' => 'Everything to make your home beautiful and functional.'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'description' => 'Watches, bags, sunglasses and more.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
