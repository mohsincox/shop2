<x-layouts.app :title="__('Checkout')">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="text-sm text-slate-500">
            <a href="{{ route('cart.index') }}" class="hover:text-indigo-600">{{ __("Cart") }}</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-slate-900">{{ __("Checkout") }}</span>
        </nav>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">{{ __("Checkout") }}</h1>

        <form method="POST" action="{{ route('checkout.store') }}" class="mt-8 grid gap-8 lg:grid-cols-[1fr_400px]">
            @csrf

            <div class="space-y-6">
                {{-- Contact --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">1</span>
                        <h2 class="text-lg font-extrabold text-slate-900">{{ __("Contact details") }}</h2>
                    </div>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Full name") }}</label>
                            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('name') border-rose-400 @enderror">
                            @error('name')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Email") }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('email') border-rose-400 @enderror">
                            @error('email')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Phone (optional)") }}</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        </div>
                    </div>
                </div>

                {{-- {{ __("Shipping") }} --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">2</span>
                        <h2 class="text-lg font-extrabold text-slate-900">{{ __("Shipping address") }}</h2>
                    </div>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="address" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Street address") }}</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}" required placeholder="123 Market Street"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('address') border-rose-400 @enderror">
                            @error('address')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="city" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("City") }}</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" required
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('city') border-rose-400 @enderror">
                            @error('city')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="zip" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("ZIP / Postal code") }}</label>
                            <input type="text" id="zip" name="zip" value="{{ old('zip') }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">3</span>
                        <h2 class="text-lg font-extrabold text-slate-900">{{ __("Payment method") }}</h2>
                    </div>
                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-4 transition has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="payment_method" value="cod" class="h-4 w-4 text-indigo-600" checked>
                            <span>
                                <span class="block text-sm font-bold text-slate-900">{{ __("Cash on Delivery") }}</span>
                                <span class="block text-xs text-slate-500">{{ __("Pay when your order arrives") }}</span>
                            </span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-4 transition has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="payment_method" value="card" class="h-4 w-4 text-indigo-600">
                            <span>
                                <span class="block text-sm font-bold text-slate-900">{{ __("Credit / Debit Card") }}</span>
                                <span class="block text-xs text-slate-500">💳 {{ __("Visa · Mastercard") }}</span>
                            </span>
                        </label>
                    </div>
                    @if (old('payment_method') === 'card' || request()->is('checkout'))
                        <div data-card-fields class="mt-4 grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="card_number" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Card number") }}</label>
                                <input type="text" id="card_number" placeholder="4242 4242 4242 4242" readonly
                                    class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-400">
                            </div>
                            <div>
                                <label for="card_expiry" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Expiry") }}</label>
                                <input type="text" id="card_expiry" placeholder="MM/YY" readonly
                                    class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-400">
                            </div>
                            <div>
                                <label for="card_cvc" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("CVC") }}</label>
                                <input type="text" id="card_cvc" placeholder="123" readonly
                                    class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-400">
                            </div>
                            <p class="sm:col-span-2 text-xs text-slate-400">💡 {{ __("Demo store — card payments are simulated. Please use") }} {{ __("Cash on Delivery") }}.</p>
                        </div>
                    @endif
                </div>

                {{-- Notes --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <label for="notes" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Order notes (optional)") }}</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Any special delivery instructions..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Summary --}}
            <div class="h-fit rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:sticky lg:top-24">
                <h2 class="text-lg font-extrabold text-slate-900">{{ __("Your order") }}</h2>
                <ul class="mt-5 divide-y divide-slate-100">
                    @foreach ($items as $line)
                        <li class="flex items-center gap-3 py-3">
                            <div class="relative">
                                <img src="{{ $line['product']->image ?: 'https://picsum.photos/seed/'.$line['product']->slug.'/100/100' }}" alt="{{ $line['product']->name }}"
                                    class="h-14 w-14 rounded-lg object-cover">
                                <span class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-slate-900 text-[10px] font-bold text-white">{{ $line['quantity'] }}</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-slate-900">{{ $line['product']->name }}</p>
                                <p class="text-xs text-slate-500">${{ number_format($line['unit_price'], 2) }} {{ __("each") }}</p>
                            </div>
                            <span class="text-sm font-bold text-slate-900">${{ number_format($line['line_total'], 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                <dl class="mt-4 space-y-3 border-t border-slate-200 pt-4 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500">{{ __("Subtotal") }}</dt>
                        <dd class="font-semibold">${{ number_format($subtotal, 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">{{ __("Shipping") }}</dt>
                        <dd class="font-semibold text-emerald-600">{{ $subtotal >= 100 ? __('Free') : '$5.99' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">{{ __("Tax (8%)") }}</dt>
                        <dd class="font-semibold">${{ number_format($tax, 2) }}</dd>
                    </div>
                    <div class="flex justify-between border-t border-slate-200 pt-3">
                        <dt class="text-base font-extrabold text-slate-900">{{ __("Total") }}</dt>
                        <dd class="text-base font-extrabold text-indigo-600">${{ number_format($subtotal + ($subtotal >= 100 ? 0 : 5.99) + $tax, 2) }}</dd>
                    </div>
                </dl>

                <button type="submit"
                    class="mt-6 flex w-full items-center justify-center gap-2 rounded-full bg-indigo-600 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-700">
                    {{ __('Place order · $:amount', ['amount' => number_format($subtotal + ($subtotal >= 100 ? 0 : 5.99) + $tax, 2)]) }}
                </button>
                <p class="mt-4 text-center text-xs text-slate-400">🔒 {{ __("Secure checkout · You won't be charged until dispatch") }}</p>
            </div>
        </form>
    </div>
</x-layouts.app>
