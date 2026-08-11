<x-layouts.app title="Shopping cart">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Shopping cart</h1>
        <p class="mt-2 text-slate-500">{{ $count }} {{ $count === 1 ? 'item' : 'items' }} in your cart</p>

        @if ($items->isEmpty())
            <div class="mt-10 flex flex-col items-center rounded-3xl border border-dashed border-slate-300 bg-white py-24 text-center">
                <span class="text-6xl">🛒</span>
                <h2 class="mt-6 text-xl font-bold text-slate-900">Your cart is empty</h2>
                <p class="mt-2 max-w-sm text-sm text-slate-500">Looks like you haven't added anything yet. Let's find something you'll love!</p>
                <a href="{{ route('shop.index') }}" class="mt-8 rounded-full bg-indigo-600 px-8 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-indigo-700">
                    Start shopping
                </a>
            </div>
        @else
            <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_360px]">
                {{-- Items --}}
                <div class="space-y-4">
                    @foreach ($items as $line)
                        @php $product = $line['product']; @endphp
                        <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center">
                            <a href="{{ route('shop.show', $product->slug) }}" class="block h-28 w-28 shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:h-24 sm:w-24">
                                <img src="{{ $product->image ?: 'https://picsum.photos/seed/'.$product->slug.'/300/300' }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            </a>

                            <div class="flex-1">
                                <a href="{{ route('shop.show', $product->slug) }}" class="text-sm font-bold text-slate-900 hover:text-indigo-600">{{ $product->name }}</a>
                                <p class="mt-0.5 text-xs text-slate-500">{{ $product->category?->name }}</p>
                                <p class="mt-1 text-sm font-extrabold text-slate-900">${{ number_format($product->price, 2) }}</p>
                                @if ($line['quantity'] > $product->stock)
                                    <p class="mt-1 text-xs font-semibold text-rose-600">Only {{ $product->stock }} left in stock</p>
                                @endif
                            </div>

                            <div class="flex items-center gap-4 sm:flex-col sm:items-end">
                                <form method="POST" action="{{ route('cart.update') }}" class="flex items-center rounded-full border border-slate-300">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" name="quantity" value="{{ max($line['quantity'] - 1, 1) }}" class="flex h-9 w-9 items-center justify-center rounded-l-full text-slate-500 hover:text-indigo-600">−</button>
                                    <input type="number" value="{{ $line['quantity'] }}" min="1" max="99"
                                        class="h-9 w-12 border-x border-slate-200 text-center text-xs font-bold focus:outline-none">
                                    <button type="submit" name="quantity" value="{{ min($line['quantity'] + 1, 99) }}" class="flex h-9 w-9 items-center justify-center rounded-r-full text-slate-500 hover:text-indigo-600">+</button>
                                </form>

                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-extrabold text-slate-900">${{ number_format($line['line_total'], 2) }}</span>
                                    <form method="POST" action="{{ route('cart.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="rounded-full p-2 text-slate-400 transition hover:bg-rose-50 hover:text-rose-600" title="Remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="flex justify-end">
                        <a href="{{ route('shop.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">← Continue shopping</a>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="h-fit rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:sticky lg:top-24">
                    <h2 class="text-lg font-extrabold text-slate-900">Order summary</h2>
                    <dl class="mt-6 space-y-4 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-slate-500">Subtotal</dt>
                            <dd class="font-semibold text-slate-900">${{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-slate-500">Shipping</dt>
                            <dd class="font-semibold text-emerald-600">{{ $subtotal >= 100 ? 'Free' : '$5.99' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-slate-500">Estimated tax (8%)</dt>
                            <dd class="font-semibold text-slate-900">${{ number_format($subtotal * 0.08, 2) }}</dd>
                        </div>
                        @if ($subtotal < 100)
                            <div class="rounded-xl bg-amber-50 px-4 py-3 text-xs text-amber-700">
                                Add <span class="font-bold">${{ number_format(100 - $subtotal, 2) }}</span> more to unlock free shipping 🚚
                            </div>
                        @endif
                        <div class="flex justify-between border-t border-slate-200 pt-4">
                            <dt class="text-base font-extrabold text-slate-900">Total</dt>
                            <dd class="text-base font-extrabold text-indigo-600">${{ number_format($subtotal + ($subtotal >= 100 ? 0 : 5.99) + $subtotal * 0.08, 2) }}</dd>
                        </div>
                    </dl>

                    <a href="{{ route('checkout.index') }}"
                        class="mt-6 flex w-full items-center justify-center gap-2 rounded-full bg-indigo-600 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-700">
                        Proceed to checkout
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <p class="mt-4 text-center text-xs text-slate-400">Secure checkout · SSL encrypted</p>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
