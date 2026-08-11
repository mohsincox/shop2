<x-layouts.admin title="Orders">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-2">
            <select name="status" onchange="this.form.submit()"
                class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm focus:border-indigo-500 focus:outline-none">
                <option value="">All statuses</option>
                @foreach (\App\Models\Order::STATUSES as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </form>
        <p class="text-sm text-slate-500">{{ $orders->total() }} orders found</p>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-400">
                        <th class="px-6 py-3.5 font-bold">Order</th>
                        <th class="px-6 py-3.5 font-bold">Customer</th>
                        <th class="px-6 py-3.5 font-bold">Date</th>
                        <th class="px-6 py-3.5 font-bold">Status</th>
                        <th class="px-6 py-3.5 font-bold">Payment</th>
                        <th class="px-6 py-3.5 text-right font-bold">Total</th>
                        <th class="px-6 py-3.5 text-right font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-bold text-slate-900">{{ $order->order_number }}</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $order->name }}</p>
                                <p class="text-xs text-slate-500">{{ $order->email }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $order->statusColor() }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td class="px-6 py-4 capitalize text-slate-600">{{ $order->payment_method }}</td>
                            <td class="px-6 py-4 text-right font-extrabold text-slate-900">${{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-600 transition hover:border-indigo-300 hover:text-indigo-600">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-slate-400">
                                <p class="text-4xl">&#128230;</p>
                                <p class="mt-3 font-semibold">No orders found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
</x-layouts.admin>
