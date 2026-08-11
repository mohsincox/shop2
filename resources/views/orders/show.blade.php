<x-layouts.app :title="'Order '.$order->order_number">
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="text-sm text-slate-500">
            <a href="{{ route('orders.index') }}" class="hover:text-indigo-600">{{ __("My orders") }}</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-slate-900">{{ $order->order_number }}</span>
        </nav>

        <div class="mt-6 rounded-3xl bg-gradient-to-br from-indigo-600 to-violet-700 p-8 text-white">
            <div class="flex flex-wrap items-center justify-between gap-6">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-indigo-200">{{ __("Order placed") }}</p>
                    <p class="mt-1 text-xl font-extrabold">{{ $order->created_at->format('F d, Y · h:i A') }}</p>
                    <p class="mt-1 text-sm text-indigo-200">{{ __("Order #:number", ['number' => $order->order_number]) }}</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-sm font-bold backdrop-blur">
                        <span class="h-2.5 w-2.5 rounded-full {{ in_array($order->status, ['delivered']) ? 'bg-emerald-300' : 'bg-amber-300' }}"></span>
                        {{ $order->statusLabel() }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_320px]">
            <div class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-extrabold text-slate-900">{{ __("Items") }}</h2>
                    <ul class="mt-4 divide-y divide-slate-100">
                        @foreach ($order->items as $item)
                            <li class="flex items-center gap-4 py-4">
                                <a href="{{ route('shop.show', $item->product?->slug) }}" class="block h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-slate-100">
                                    <img src="{{ $item->product?->image ?: 'https://picsum.photos/seed/'.$item->product?->slug.'/150/150' }}" alt="{{ $item->product_name }}" class="h-full w-full object-cover">
                                </a>
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-900">{{ $item->product_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                                </div>
                                <span class="font-bold text-slate-900">${{ number_format($item->total, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-sm font-extrabold uppercase tracking-wide text-slate-900">{{ __("Shipping address") }}</h2>
                        <div class="mt-4 space-y-1 text-sm text-slate-600">
                            <p class="font-semibold text-slate-900">{{ $order->name }}</p>
                            <p>{{ $order->address }}</p>
                            <p>{{ $order->city }}{{ $order->zip ? ', '.$order->zip : '' }}</p>
                            <p>{{ $order->phone }}</p>
                            <p>{{ $order->email }}</p>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-sm font-extrabold uppercase tracking-wide text-slate-900">{{ __("Payment") }}</h2>
                        <div class="mt-4 space-y-1 text-sm text-slate-600">
                            <p class="font-semibold capitalize text-slate-900">{{ $order->payment_method === 'cod' ? __('Cash on Delivery') : __('Credit / Debit Card') }}</p>
                            @if ($order->notes)
                                <p class="mt-2 text-xs text-slate-500">{{ __("Notes:") }} {{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-fit rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-extrabold text-slate-900">{{ __("Order summary") }}</h2>
                <dl class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500">{{ __("Subtotal") }}</dt>
                        <dd class="font-semibold">${{ number_format($order->subtotal, 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">{{ __("Shipping") }}</dt>
                        <dd class="font-semibold">{{ $order->shipping > 0 ? '$'.number_format($order->shipping, 2) : __('Free') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">{{ __("Tax") }}</dt>
                        <dd class="font-semibold">${{ number_format($order->tax, 2) }}</dd>
                    </div>
                    <div class="flex justify-between border-t border-slate-200 pt-3">
                        <dt class="text-base font-extrabold text-slate-900">{{ __("Total") }}</dt>
                        <dd class="text-base font-extrabold text-indigo-600">${{ number_format($order->total, 2) }}</dd>
                    </div>
                </dl>
                <a href="{{ route('shop.index') }}" class="mt-6 block rounded-full border-2 border-indigo-600 py-3 text-center text-sm font-bold text-indigo-600 transition hover:bg-indigo-50">
                    {{ __("Shop more") }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
