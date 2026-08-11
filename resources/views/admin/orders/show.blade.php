<x-layouts.admin :title="'Order '.$order->order_number">
    <nav class="text-sm text-slate-500">
        <a href="{{ route('admin.orders.index') }}" class="hover:text-indigo-600">&larr; Back to orders</a>
    </nav>

    <div class="mt-4 rounded-2xl bg-gradient-to-br from-slate-900 to-indigo-900 p-6 text-white">
        <div class="flex flex-wrap items-center justify-between gap-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Order</p>
                <p class="mt-1 text-2xl font-extrabold">{{ $order->order_number }}</p>
                <p class="mt-1 text-sm text-slate-300">Placed {{ $order->created_at->format('F d, Y · h:i A') }}</p>
            </div>
            <div class="rounded-2xl bg-white/10 px-5 py-4 backdrop-blur">
                <p class="text-xs font-bold uppercase tracking-widest text-slate-300">Total</p>
                <p class="mt-1 text-2xl font-extrabold text-emerald-300">${{ number_format($order->total, 2) }}</p>
            </div>
        </div>

        {{-- Status update --}}
        <div class="mt-6 flex flex-wrap items-center gap-4 border-t border-white/10 pt-6">
            <span class="rounded-full px-3 py-1.5 text-xs font-bold bg-white/15">{{ ucfirst($order->status) }}</span>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="flex items-center gap-2">
                @csrf
                @method('PATCH')
                <select name="status"
                    class="rounded-xl border-0 bg-white/95 px-4 py-2 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    @foreach (\App\Models\Order::STATUSES as $status)
                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-xl bg-indigo-500 px-5 py-2 text-sm font-bold text-white transition hover:bg-indigo-400">
                    Update status
                </button>
            </form>
        </div>
    </div>

    <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_340px]">
        {{-- Items --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-4">
                <h2 class="font-extrabold text-slate-900">Order items ({{ $order->items->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-400">
                            <th class="px-6 py-3.5 font-bold">Product</th>
                            <th class="px-6 py-3.5 font-bold">Price</th>
                            <th class="px-6 py-3.5 font-bold">Qty</th>
                            <th class="px-6 py-3.5 text-right font-bold">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $item->product?->image ?: 'https://picsum.photos/seed/'.$item->product?->slug.'/100/100' }}" alt="{{ $item->product_name }}"
                                            class="h-11 w-11 rounded-lg object-cover">
                                        <span class="font-bold text-slate-900">{{ $item->product_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">${{ number_format($item->price, 2) }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-right font-extrabold text-slate-900">${{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Customer & summary --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-sm font-extrabold uppercase tracking-wide text-slate-900">Customer</h2>
                <div class="mt-4 flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-bold text-white">
                        {{ strtoupper(substr($order->name, 0, 1)) }}
                    </span>
                    <div>
                        <p class="font-bold text-slate-900">{{ $order->name }}</p>
                        <p class="text-xs text-slate-500">{{ $order->email }}</p>
                        @if ($order->phone)
                            <p class="text-xs text-slate-500">{{ $order->phone }}</p>
                        @endif
                    </div>
                </div>
                <div class="mt-5 space-y-1 text-sm text-slate-600">
                    <p class="font-semibold text-slate-800">Shipping to:</p>
                    <p>{{ $order->address }}, {{ $order->city }}{{ $order->zip ? ' '.$order->zip : '' }}</p>
                    <p class="mt-2 font-semibold text-slate-800">Payment: <span class="font-normal capitalize">{{ $order->payment_method }}</span></p>
                    @if ($order->notes)
                        <p class="mt-2 text-xs italic text-slate-500">"{{ $order->notes }}"</p>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-sm font-extrabold uppercase tracking-wide text-slate-900">Summary</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500">Subtotal</dt>
                        <dd class="font-semibold">${{ number_format($order->subtotal, 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">Shipping</dt>
                        <dd class="font-semibold">{{ $order->shipping > 0 ? '$'.number_format($order->shipping, 2) : 'Free' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">Tax</dt>
                        <dd class="font-semibold">${{ number_format($order->tax, 2) }}</dd>
                    </div>
                    <div class="flex justify-between border-t border-slate-200 pt-3">
                        <dt class="text-base font-extrabold text-slate-900">Total</dt>
                        <dd class="text-base font-extrabold text-indigo-600">${{ number_format($order->total, 2) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-layouts.admin>
