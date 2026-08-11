<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cart)
    {
    }

    /**
     * Show the cart page.
     */
    public function index()
    {
        return view('cart', [
            'items' => $this->cart->content(),
            'subtotal' => $this->cart->subtotal(),
            'count' => $this->cart->count(),
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < 1) {
            return back()->withErrors(['message' => 'Sorry, this product is out of stock.']);
        }

        $this->cart->add($product->id, $request->integer('quantity', 1));

        return back()->with('success', '"'.$product->name.'" was added to your cart.');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $this->cart->update($request->product_id, $request->quantity);

        return back()->with('success', 'Your cart has been updated.');
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $this->cart->remove($request->product_id);

        return back()->with('success', 'Item removed from your cart.');
    }

    /**
     * Get the current cart summary (used by the header badge).
     */
    public function count()
    {
        return response()->json([
            'count' => $this->cart->count(),
            'subtotal' => $this->cart->subtotal(),
        ]);
    }
}
