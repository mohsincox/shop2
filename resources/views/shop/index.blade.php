<x-layouts.app :title="__('Shop')">
    {{-- Page header --}}
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <nav class="text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-indigo-600">{{ __("Home") }}</a>
                <span class="mx-2">/</span>
                <span class="font-semibold text-slate-900">{{ __("Shop") }}</span>
                @if (request('category'))
                    <span class="mx-2">/</span>
                    <span class="text-indigo-600">{{ $categories->firstWhere('slug', request('category'))?->name }}</span>
                @endif
            </nav>
            <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                {{ request('category') ? $categories->firstWhere('slug', request('category'))?->name : __('All products') }}
            </h1>
            <p class="mt-2 text-slate-500">{{ $products->total() }} {{ __("products found") }}</p>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[240px_1fr]">
            {{-- Sidebar filters --}}
            <aside class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h2 class="text-sm font-bold uppercase tracking-wide text-slate-900">{{ __("Categories") }}</h2>
                    <ul class="mt-4 space-y-1.5">
                        <li>
                            <a href="{{ route('shop.index') }}"
                                class="flex items-center justify-between rounded-lg px-3 py-2 text-sm {{ !request('category') ? 'bg-indigo-50 font-semibold text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                                <span>{{ __("All categories") }}</span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm {{ request('category') === $category->slug ? 'bg-indigo-50 font-semibold text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs text-slate-400">{{ $category->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h2 class="text-sm font-bold uppercase tracking-wide text-slate-900">{{ __("Sort by") }}</h2>
                    @php
                        $sortOptions = [
                            'latest' => __('Newest first'),
                            'price_asc' => __('Price: low to high'),
                            'price_desc' => __('Price: high to low'),
                            'name' => __('Name (A–Z)'),
                        ];
                    @endphp
                    <ul class="mt-4 space-y-1.5">
                        @foreach ($sortOptions as $key => $label)
                            <li>
                                <a href="{{ route('shop.index', array_merge(request()->only(['category', 'q']), ['sort' => $key])) }}"
                                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm {{ request('sort', 'latest') === $key ? 'bg-indigo-50 font-semibold text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <a href="{{ route('cart.index') }}" class="block rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 p-5 text-white shadow-lg">
                    <p class="text-2xl">🛒</p>
                    <p class="mt-2 text-sm font-bold">{{ __("Your cart") }}</p>
                    <p class="mt-0.5 text-xs text-indigo-100">{{ $cartCount }} {{ __("items") }} · ${{ number_format($cartSubtotal, 2) }}</p>
                </a>
            </aside>

            {{-- Product grid --}}
            <div>
                @if ($products->isEmpty())
                    <div class="flex flex-col items-center rounded-2xl border border-dashed border-slate-300 bg-white py-24 text-center">
                        <span class="text-5xl">🔍</span>
                        <h3 class="mt-4 text-lg font-bold text-slate-900">No {{ __("products found") }}</h3>
                        <p class="mt-1 text-sm text-slate-500">{{ __("Try adjusting your search or filters.") }}</p>
                        <a href="{{ route('shop.index') }}" class="mt-6 rounded-full bg-indigo-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-indigo-700">
                            {{ __("Clear filters") }}
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
