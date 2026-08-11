@props(['product'])

@php
    $image = $product->image ?: 'https://picsum.photos/seed/'.$product->slug.'/600/600';
@endphp

<div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
    <a href="{{ route('shop.show', $product->slug) }}" class="block aspect-square overflow-hidden bg-slate-100">
        <img src="{{ $image }}" alt="{{ $product->name }}" loading="lazy"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
    </a>

    @if ($product->featured)
        <span class="absolute left-3 top-3 rounded-full bg-indigo-600 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-white shadow">Featured</span>
    @elseif (!$product->isInStock())
        <span class="absolute left-3 top-3 rounded-full bg-rose-600 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-white shadow">Sold out</span>
    @endif

    <div class="p-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-indigo-500">{{ $product->category?->name }}</p>
        <a href="{{ route('shop.show', $product->slug) }}" class="mt-1 line-clamp-1 block text-sm font-semibold text-slate-900 hover:text-indigo-600">
            {{ $product->name }}
        </a>
        <div class="mt-3 flex items-center justify-between">
            <div>
                @if ($product->featured)
                    <span class="mr-2 text-xs text-slate-400 line-through">${{ number_format($product->price, 2) }}</span>
                @endif
                <span class="text-lg font-extrabold text-slate-900">${{ number_format($product->price, 2) }}</span>
            </div>
            <form method="POST" action="{{ route('cart.index') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" {{ $product->isInStock() ? '' : 'disabled' }}
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-white shadow-md transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:bg-slate-300"
                    title="Add to cart">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
