<x-layouts.admin :title="__('Customer').' · '.$user->name">name">
    <nav class="text-sm text-slate-500">
        <a href="{{ route('admin.users.index') }}" class="hover:text-indigo-600">&larr; {{ __("Back to customers") }}</a>
    </nav>

    <div class="mt-4 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-700 p-6 text-white">
        <div class="flex flex-wrap items-center gap-6">
            <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/15 text-2xl font-extrabold backdrop-blur">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </span>
            <div class="flex-1">
                <p class="text-2xl font-extrabold">{{ $user->name }}</p>
                <p class="text-indigo-100">{{ $user->email }}</p>
                <p class="mt-1 text-xs text-indigo-200">Joined {{ $user->created_at->format('F d, Y') }}</p>
            </div>
            <div class="rounded-2xl bg-white/10 px-6 py-4 text-center backdrop-blur">
                <p class="text-2xl font-extrabold">{{ $user->orders_count }}</p>
                <p class="text-xs text-indigo-200">{{ __("Total orders") }}</p>
            </div>
        </div>
    </div>

    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-4">
            <h2 class="font-extrabold text-slate-900">{{ __("Order history") }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-400">
                        <th class="px-6 py-3.5 font-bold">{{ __("Order") }}</th>
                        <th class="px-6 py-3.5 font-bold">{{ __("Date") }}</th>
                        <th class="px-6 py-3.5 font-bold">{{ __("Status") }}</th>
                        <th class="px-6 py-3.5 text-right font-bold">{{ __("Total") }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-indigo-600 hover:text-indigo-700">{{ $order->order_number }}</a>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $order->statusColor() }}">{{ $order->statusLabel() }}</span>
                            </td>
                            <td class="px-6 py-4 text-right font-extrabold text-slate-900">${{ number_format($order->total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center text-slate-400">
                                <p class="text-4xl">&#128230;</p>
                                <p class="mt-3 font-semibold">{{ __("This customer hasn't placed any orders yet.") }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
