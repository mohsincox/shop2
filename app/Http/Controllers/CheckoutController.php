<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct(private CartService $cart)
    {
    }

    /**
     * Show the checkout form.
     */
    public function index()
    {
        if ($this->cart->count() === 0) {
            return redirect()->route('cart.index')->with('info', 'Your cart is empty. Add some products first.');
        }

        return view('checkout', [
            'items' => $this->cart->content(),
            'subtotal' => $this->cart->subtotal(),
            'tax' => round($this->cart->subtotal() * 0.08, 2),
            'shipping' => 5.99,
        ]);
    }

    /**
     * Place the order.
     */
    public function store(Request $request)
    {
        $subtotal = $this->cart->subtotal();
        $tax = round($subtotal * 0.08, 2);
        $shipping = $subtotal >= 100 ? 0.00 : 5.99;
        $total = round($subtotal + $tax + $shipping, 2);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['nullable', 'string', 'max:20'],
            'payment_method' => ['required', 'in:cod,card'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = DB::transaction(function () use ($data, $subtotal, $tax, $shipping, $total) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-'.strtoupper(uniqid()),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                ...$data,
            ]);

            foreach ($this->cart->content() as $line) {
                /** @var Product $product */
                $product = $line['product'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $line['quantity'],
                    'total' => $line['line_total'],
                ]);

                $product->decrement('stock', $line['quantity']);
            }

            return $order;
        });

        $this->cart->clear();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Thank you! Your order has been placed successfully.');
    }
}
