<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    private const KEY = 'cart';

    public function __construct()
    {
        if (! session()->has(self::KEY)) {
            session()->put(self::KEY, []);
        }
    }

    /**
     * Add a product to the cart.
     */
    public function add(int $productId, int $quantity = 1): void
    {
        $cart = $this->items();

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put(self::KEY, $cart);
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(int $productId, int $quantity): void
    {
        $cart = $this->items();

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put(self::KEY, $cart);
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(int $productId): void
    {
        $cart = $this->items();
        unset($cart[$productId]);
        session()->put(self::KEY, $cart);
    }

    /**
     * Clear the cart.
     */
    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    /**
     * The raw cart items keyed by product id.
     *
     * @return array<int, int>
     */
    public function items(): array
    {
        return session()->get(self::KEY, []);
    }

    /**
     * The full cart content as a collection of line items.
     */
    public function content(): Collection
    {
        $items = $this->items();

        if (empty($items)) {
            return collect();
        }

        $products = Product::with('category')
            ->whereIn('id', array_keys($items))
            ->get();

        return $products->map(function (Product $product) use ($items) {
            $quantity = $items[$product->id];
            $unitPrice = $product->price;

            return [
                'product' => $product,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'line_total' => round($unitPrice * $quantity, 2),
            ];
        });
    }

    /**
     * The number of distinct products in the cart.
     */
    public function count(): int
    {
        return array_sum($this->items());
    }

    /**
     * The subtotal of the whole cart.
     */
    public function subtotal(): float
    {
        return round($this->content()->sum('line_total'), 2);
    }
}
