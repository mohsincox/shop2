<x-layouts.app :title="$product->name">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="text-sm text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-indigo-600">Shop</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.index', ['category' => $product->category?->slug]) }}" class="hover:text-indigo-600">{{ $product->category?->name }}</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-slate-900">{{ $product->name }}</span>
        </nav>

        <div class="mt-8 grid gap-10 lg:grid-cols-2 lg:gap-16">
            {{-- Product image --}}
            <div class="relative">
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                    <img src="{{ $product->image ?: 'https://picsum.photos/seed/'.$product->slug.'/800/800' }}" alt="{{ $product->name }}"
                        class="aspect-square w-full object-cover">
                </div>
                @if ($product->featured)
                    <span class="absolute left-4 top-4 rounded-full bg-indigo-600 px-3 py-1.5 text-xs font-bold uppercase tracking-wide text-white shadow-lg">Featured</span>
                @endif
                @if (!$product->isInStock())
                    <span class="absolute left-4 top-4 rounded-full bg-rose-600 px-3 py-1.5 text-xs font-bold uppercase tracking-wide text-white shadow-lg">Sold out</span>
                @endif
            </div>

            {{-- Product info --}}
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">{{ $product->category?->name }}</p>
                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">{{ $product->name }}</h1>

                <div class="mt-4 flex items-center gap-2 text-sm text-slate-500">
                    <span class="flex text-amber-400">★★★★★</span>
                    <span class="font-semibold text-slate-900">4.9</span>
                    <span>(128 reviews)</span>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    @if ($product->featured)
                        <span class="text-lg text-slate-400 line-through">${{ number_format($product->price, 2) }}</span>
                        <span class="text-4xl font-extrabold text-indigo-600">${{ number_format($product->discounted_price, 2) }}</span>
                    @else
                        <span class="text-4xl font-extrabold text-slate-900">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <p class="mt-6 leading-relaxed text-slate-600">{{ $product->description }}</p>

                <div class="mt-6 flex items-center gap-3">
                    @if ($product->isInStock())
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span> In stock · {{ $product->stock }} available
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-bold text-rose-700">
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span> Out of stock
                        </span>
                    @endif
                </div>

                {{-- Add to cart --}}
                <form method="POST" action="{{ route('cart.index') }}" class="mt-8 flex flex-wrap items-center gap-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="flex items-center rounded-full border border-slate-300 bg-white">
                        <button type="button" data-qty-minus class="flex h-12 w-12 items-center justify-center rounded-l-full text-slate-500 hover:text-indigo-600">−</button>
                        <input type="number" name="quantity" value="1" min="1" max="{{ max($product->stock, 1) }}"
                            class="h-12 w-14 border-x border-slate-200 text-center text-sm font-bold focus:outline-none" data-qty-input>
                        <button type="button" data-qty-plus class="flex h-12 w-12 items-center justify-center rounded-r-full text-slate-500 hover:text-indigo-600">+</button>
                    </div>
                    <button type="submit" {{ $product->isInStock() ? '' : 'disabled' }}
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-indigo-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:bg-slate-300 disabled:shadow-none sm:flex-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        Add to cart
                    </button>
                </form>

                {{-- Perks --}}
                <div class="mt-10 grid grid-cols-3 gap-3 rounded-2xl border border-slate-200 bg-white p-5 text-center">
                    <div>
                        <p class="text-xl">🚚</p>
                        <p class="mt-1 text-xs font-semibold text-slate-700">Free shipping</p>
                        <p class="text-[11px] text-slate-500">Orders $100+</p>
                    </div>
                    <div>
                        <p class="text-xl">↩️</p>
                        <p class="mt-1 text-xs font-semibold text-slate-700">Easy returns</p>
                        <p class="text-[11px] text-slate-500">30 days</p>
                    </div>
                    <div>
                        <p class="text-xl">🛡️</p>
                        <p class="mt-1 text-xs font-semibold text-slate-700">Secure checkout</p>
                        <p class="text-[11px] text-slate-500">SSL encrypted</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related products --}}
        @if ($related->isNotEmpty())
            <section class="mt-20">
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">You may also like</h2>
                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $item)
                        <x-product-card :product="$item" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('[data-qty-plus], [data-qty-minus]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const input = btn.closest('form').querySelector('[data-qty-input]');
                    let value = parseInt(input.value) || 1;
                    value += btn.hasAttribute('data-qty-plus') ? 1 : -1;
                    value = Math.max(1, Math.min(value, parseInt(input.max) || 99));
                    input.value = value;
                });
            });
        </script>
    @endpush
</x-layouts.app>
