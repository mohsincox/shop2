<x-layouts.admin title="Dashboard">
    {{-- Stat cards --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Total revenue</p>
                    <p class="mt-2 text-2xl font-extrabold text-slate-900">${{ number_format($totalRevenue, 2) }}</p>
                    <p class="mt-1 text-xs text-emerald-600 font-semibold">&#9650; Lifetime earnings</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-2xl">&#128176;</span>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Total orders</p>
                    <p class="mt-2 text-2xl font-extrabold text-slate-900">{{ $totalOrders }}</p>
                    <p class="mt-1 text-xs text-slate-400 font-semibold">All time</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-2xl">&#128230;</span>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Products</p>
                    <p class="mt-2 text-2xl font-extrabold text-slate-900">{{ $totalProducts }}</p>
                    <p class="mt-1 text-xs {{ $lowStock > 0 ? 'text-amber-600 font-semibold' : 'text-emerald-600 font-semibold' }}">
                        {{ $lowStock > 0 ? '&#9888; '.$lowStock.' low in stock' : 'All stocked up' }}
                    </p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-2xl">&#127873;</span>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Customers</p>
                    <p class="mt-2 text-2xl font-extrabold text-slate-900">{{ $totalCustomers }}</p>
                    <p class="mt-1 text-xs text-slate-400 font-semibold">Registered accounts</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-2xl">&#128101;</span>
            </div>
        </div>
    </div>

    {{-- Order status breakdown + recent customers --}}
    <div class="mt-8 grid gap-8 lg:grid-cols-3">
        {{-- Recent orders --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                <h2 class="font-extrabold text-slate-900">Recent orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">View all &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 text-left text-xs uppercase tracking-wider text-slate-400">
                            <th class="px-6 py-3 font-bold">Order</th>
                            <th class="px-6 py-3 font-bold">Customer</th>
                            <th class="px-6 py-3 font-bold">Date</th>
                            <th class="px-6 py-3 font-bold">Status</th>
                            <th class="px-6 py-3 text-right font-bold">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($recentOrders as $order)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-3.5 font-bold text-slate-900">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="hover:text-indigo-600">{{ $order->order_number }}</a>
                                </td>
                                <td class="px-6 py-3.5 text-slate-600">{{ $order->user?->name }}</td>
                                <td class="px-6 py-3.5 text-slate-500">{{ $order->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-3.5">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $order->statusColor() }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td class="px-6 py-3.5 text-right font-extrabold text-slate-900">${{ number_format($order->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">No orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Right column --}}
        <div class="space-y-8">
            {{-- Order status breakdown --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="font-extrabold text-slate-900">Orders by status</h2>
                <div class="mt-5 space-y-4">
                    @foreach (\App\Models\Order::STATUSES as $status)
                        @php
                            $count = $ordersByStatus[$status] ?? 0;
                            $pct = $totalOrders > 0 ? round($count / $totalOrders * 100) : 0;
                            $colors = [
                                'pending' => 'bg-amber-400',
                                'processing' => 'bg-blue-500',
                                'shipped' => 'bg-indigo-500',
                                'delivered' => 'bg-emerald-500',
                                'cancelled' => 'bg-rose-500',
                            ];
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-semibold capitalize text-slate-700">{{ $status }}</span>
                                <span class="font-bold text-slate-900">{{ $count }}</span>
                            </div>
                            <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-slate-100">
                                <div class="h-full rounded-full {{ $colors[$status] }}" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Recent customers --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                    <h2 class="font-extrabold text-slate-900">New customers</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">View all &rarr;</a>
                </div>
                <ul class="divide-y divide-slate-100">
                    @forelse ($recentCustomers as $customer)
                        <li class="flex items-center gap-3 px-6 py-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-xs font-bold text-white">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </span>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-slate-900">{{ $customer->name }}</p>
                                <p class="truncate text-xs text-slate-500">{{ $customer->email }}</p>
                            </div>
                            <span class="ml-auto text-xs text-slate-400">{{ $customer->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li class="px-6 py-8 text-center text-sm text-slate-400">No customers yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-layouts.admin>
