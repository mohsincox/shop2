<x-layouts.app>
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 30%, white 1.5px, transparent 1.5px); background-size: 40px 40px;"></div>
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:items-center lg:px-8 lg:py-28">
            <div class="relative">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-xs font-semibold uppercase tracking-widest backdrop-blur">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-300"></span> Summer Sale · Up to 40% off
                </span>
                <h1 class="mt-6 text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                    Discover the best products, <span class="bg-gradient-to-r from-amber-300 to-pink-300 bg-clip-text text-transparent">at the best prices</span>
                </h1>
                <p class="mt-6 max-w-xl text-lg text-indigo-100">
                    From everyday essentials to premium finds — explore our carefully curated catalog and enjoy fast, free delivery on orders over $100.
                </p>
                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <a href="{{ route('shop.index') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-white px-8 py-3.5 text-sm font-bold text-indigo-700 shadow-xl transition hover:bg-indigo-50 hover:shadow-2xl">
                        Shop now
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('shop.index', ['sort' => 'price_asc']) }}"
                        class="inline-flex items-center gap-2 rounded-full border-2 border-white/40 px-8 py-3.5 text-sm font-bold text-white transition hover:bg-white/10">
                        View deals
                    </a>
                </div>
                <div class="mt-12 flex flex-wrap gap-10">
                    <div>
                        <p class="text-3xl font-extrabold">10k+</p>
                        <p class="text-sm text-indigo-200">Happy customers</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold">500+</p>
                        <p class="text-sm text-indigo-200">Products</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold">24h</p>
                        <p class="text-sm text-indigo-200">Fast delivery</p>
                    </div>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="grid grid-cols-2 gap-5">
                    <div class="space-y-5 pt-10">
                        <img src="https://picsum.photos/seed/hero1/400/500" alt="Product" class="aspect-[4/5] w-full rounded-3xl object-cover shadow-2xl ring-4 ring-white/20">
                        <img src="https://picsum.photos/seed/hero2/400/500" alt="Product" class="aspect-[4/5] w-full rounded-3xl object-cover shadow-2xl ring-4 ring-white/20">
                    </div>
                    <div class="space-y-5">
                        <img src="https://picsum.photos/seed/hero3/400/500" alt="Product" class="aspect-[4/5] w-full rounded-3xl object-cover shadow-2xl ring-4 ring-white/20">
                        <img src="https://picsum.photos/seed/hero4/400/500" alt="Product" class="aspect-[4/5] w-full rounded-3xl object-cover shadow-2xl ring-4 ring-white/20">
                    </div>
                </div>
                <div class="absolute -bottom-6 left-1/2 flex -translate-x-1/2 items-center gap-3 rounded-2xl bg-white px-6 py-4 shadow-2xl">
                    <span class="text-2xl">🚚</span>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Free shipping</p>
                        <p class="text-xs text-slate-500">On orders over $100</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Trust badges --}}
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-6 px-4 py-8 sm:px-6 lg:grid-cols-4 lg:px-8">
            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-2xl">🛡️</span>
                <div>
                    <p class="text-sm font-bold text-slate-900">Secure payment</p>
                    <p class="text-xs text-slate-500">256-bit SSL encrypted</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-2xl">↩️</span>
                <div>
                    <p class="text-sm font-bold text-slate-900">Easy returns</p>
                    <p class="text-xs text-slate-500">30-day return policy</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-2xl">💎</span>
                <div>
                    <p class="text-sm font-bold text-slate-900">Premium quality</p>
                    <p class="text-xs text-slate-500">Hand-picked products</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-2xl">🎧</span>
                <div>
                    <p class="text-sm font-bold text-slate-900">24/7 support</p>
                    <p class="text-xs text-slate-500">Always here to help</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    @if ($categories->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">Browse by category</p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">Shop by category</h2>
                </div>
                <a href="{{ route('shop.index') }}" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-700 sm:block">View all →</a>
            </div>
            <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
                @foreach ($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                        class="group flex flex-col items-center gap-3 rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm transition hover:-translate-y-1 hover:border-indigo-300 hover:shadow-lg">
                        <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-100 to-violet-100 text-3xl transition group-hover:scale-110">
                            {{ $loop->first ? '👟' : ($loop->index === 1 ? '📱' : ($loop->index === 2 ? '👕' : ($loop->index === 3 ? '💄' : ($loop->index === 4 ? '🏠' : '⌚')))) }}
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-900 group-hover:text-indigo-600">{{ $category->name }}</p>
                            <p class="text-xs text-slate-500">{{ $category->products_count }} items</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Featured products --}}
    @if ($featured->isNotEmpty())
        <section class="bg-white py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">Hand-picked</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">Featured products</h2>
                    </div>
                    <a href="{{ route('shop.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">View all →</a>
                </div>
                <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($featured as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Promo banner --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-900 px-8 py-14 text-white sm:px-14">
            <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-indigo-500/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-violet-500/30 blur-3xl"></div>
            <div class="relative flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-amber-400">Limited time offer</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">New season, new favorites</h2>
                    <p class="mt-3 max-w-lg text-slate-300">Refresh your style with the latest arrivals. Members get free shipping on every order.</p>
                </div>
                <a href="{{ route('shop.index', ['sort' => 'latest']) }}"
                    class="inline-flex shrink-0 items-center gap-2 rounded-full bg-white px-8 py-3.5 text-sm font-bold text-slate-900 shadow-xl transition hover:bg-indigo-50">
                    Shop new arrivals →
                </a>
            </div>
        </div>
    </section>

    {{-- New arrivals --}}
    @if ($newArrivals->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">Just in</p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">New arrivals</h2>
                </div>
                <a href="{{ route('shop.index', ['sort' => 'latest']) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>
            <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($newArrivals as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Newsletter --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm sm:p-12">
            <p class="text-3xl">💌</p>
            <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900">Stay in the loop</h2>
            <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">Subscribe to our newsletter and get 10% off your first order, plus exclusive offers.</p>
            <form class="mx-auto mt-6 flex max-w-md gap-2" onsubmit="event.preventDefault(); this.querySelector('input').value=''; this.querySelector('button').textContent='Subscribed ✓';">
                @csrf
                <input type="email" required placeholder="Enter your email"
                    class="w-full rounded-full border border-slate-300 px-5 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <button type="submit" class="shrink-0 rounded-full bg-indigo-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-indigo-700">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
</x-layouts.app>
