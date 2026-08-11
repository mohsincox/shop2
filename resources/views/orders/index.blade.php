<x-layouts.app :title="__('My orders')">
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">{{ __("My orders") }}</h1>
        <p class="mt-2 text-slate-500">{{ __("Track and manage all your purchases.") }}</p>

        @if ($orders->isEmpty())
            <div class="mt-10 flex flex-col items-center rounded-3xl border border-dashed border-slate-300 bg-white py-24 text-center">
                <span class="text-6xl">📦</span>
                <h2 class="mt-6 text-xl font-bold text-slate-900">{{ __("No orders yet") }}</h2>
                <p class="mt-2 max-w-sm text-sm text-slate-500">{{ __("When you place an order, it will show up here so you can track its status.") }}</p>
                <a href="{{ route('shop.index') }}" class="mt-8 rounded-full bg-indigo-600 px-8 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-indigo-700">
                    {{ __("Start shopping") }}
                </a>
            </div>
        @else
            <div class="mt-8 space-y-4">
                @foreach ($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="block rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-indigo-300 hover:shadow-md">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <p class="font-bold text-slate-900">{{ $order->order_number }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">{{ __("Placed on :date", ['date' => $order->created_at->format('M d, Y · h:i A')]) }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $order->statusColor() }}">{{ $order->statusLabel() }}</span>
                                <span class="text-lg font-extrabold text-slate-900">${{ number_format($order->total, 2) }}</span>
                                <span class="text-xs text-slate-400">{{ $order->items_count }} {{ $order->items_count === 1 ? __('item') : __('items') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">{{ $orders->links() }}</div>
        @endif
    </div>
</x-layouts.app>
