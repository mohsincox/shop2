<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show the storefront home page.
     */
    public function index()
    {
        $featured = Product::with('category')
            ->where('featured', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        $newArrivals = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(6)
            ->get();

        return view('home', compact('featured', 'newArrivals', 'categories'));
    }
}
