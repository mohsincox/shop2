@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title.' · ' : '' }}{{ config('app.name', 'Shop2') }}</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛍️</text></svg>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-50 font-sans text-slate-800 antialiased">
    <div class="flex min-h-full flex-col">

        {{-- Announcement bar --}}
        <div class="bg-indigo-600 px-4 py-2 text-center text-xs font-semibold text-white sm:text-sm">
            Free shipping on orders over $100 &nbsp;·&nbsp; <span class="opacity-80">New season collection just dropped</span>
        </div>

        {{-- Header --}}
        <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between gap-4">

                    {{-- Mobile menu button --}}
                    <button type="button" data-mobile-menu-toggle
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100 lg:hidden"
                        aria-label="Open menu">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-lg shadow-sm">🛍️</span>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900">
                            Shop<span class="text-indigo-600">2</span>
                        </span>
                    </a>

                    {{-- Desktop nav --}}
                    <nav class="hidden items-center gap-1 lg:flex">
                        <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900">Home</a>
                        <a href="{{ route('shop.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900">Shop</a>
                        @auth
                            <a href="{{ route('orders.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 hover:text-slate-900">My Orders</a>
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-indigo-600 hover:bg-indigo-50">Admin Panel</a>
                            @endif
                        @endauth
                    </nav>

                    {{-- Search (desktop) --}}
                    <form action="{{ route('shop.index') }}" method="GET" class="relative hidden flex-1 justify-end md:flex md:max-w-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search products..."
                            class="w-full rounded-full border border-slate-200 bg-slate-50 py-2 pl-9 pr-4 text-sm placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    </form>

                    {{-- Actions --}}
                    <div class="flex items-center gap-1.5">

                        <a href="{{ route('cart.index') }}" class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100" aria-label="Cart">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            @if ($cartCount > 0)
                                <span class="absolute -right-0.5 -top-0.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-indigo-600 px-1 text-[11px] font-bold text-white">
                                    {{ $cartCount > 99 ? '99+' : $cartCount }}
                                </span>
                            @endif
                        </a>

                        @auth
                            <div class="relative" data-dropdown>
                                <button type="button" data-dropdown-toggle class="flex h-10 items-center gap-2 rounded-full border border-slate-200 py-1 pl-1 pr-3 text-sm font-semibold text-slate-700 hover:border-slate-300 hover:bg-slate-50">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-xs font-bold text-white">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                    <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                                <div data-dropdown-menu class="absolute right-0 top-12 z-50 hidden w-56 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg">
                                    <div class="border-b border-slate-100 px-4 py-3">
                                        <p class="truncate text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                                        <p class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</p>
                                    </div>
                                    <div class="p-1.5">
                                        <a href="{{ route('orders.index') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                            <span>📦</span> My Orders
                                        </a>
                                        @if (auth()->user()->isAdmin())
                                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                                <span>⚙️</span> Admin Panel
                                            </a>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-left text-sm text-rose-600 hover:bg-rose-50">
                                                <span>🚪</span> Sign out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="hidden rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 sm:inline-flex">Sign in</a>
                            <a href="{{ route('register') }}" class="hidden rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 sm:inline-flex">Sign up</a>
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Mobile menu --}}
            <div data-mobile-menu class="hidden border-t border-slate-100 bg-white lg:hidden">
                <div class="space-y-1 px-4 py-3">
                    <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Home</a>
                    <a href="{{ route('shop.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Shop</a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">My Orders</a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-indigo-600 hover:bg-indigo-50">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-rose-600 hover:bg-rose-50">Sign out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Sign in</a>
                        <a href="{{ route('register') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-indigo-600 hover:bg-indigo-50">Sign up</a>
                    @endauth
                    <form action="{{ route('shop.index') }}" method="GET" class="relative mt-2">
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search products..."
                            class="w-full rounded-full border border-slate-200 bg-slate-50 px-4 py-2 pl-9 text-sm focus:border-indigo-400 focus:outline-none">
                    </form>
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if (session('success') || session('info') || $errors->any())
            <div class="mx-auto mt-6 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
                @if (session('success'))
                    <x-alert type="success">{{ session('success') }}</x-alert>
                @endif
                @if (session('info'))
                    <x-alert type="info">{{ session('info') }}</x-alert>
                @endif
                @if ($errors->any())
                    <x-alert type="error">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-alert>
                @endif
            </div>
        @endif

        {{-- Main content --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="mt-20 border-t border-slate-200 bg-slate-900 text-slate-300">
            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-lg">🛍️</span>
                            <span class="text-xl font-extrabold tracking-tight text-white">Shop<span class="text-indigo-400">2</span></span>
                        </a>
                        <p class="mt-4 text-sm leading-relaxed text-slate-400">
                            Your one-stop destination for quality products at unbeatable prices. Shop the latest trends today.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Shop</h3>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            <li><a href="{{ route('shop.index') }}" class="hover:text-white">All Products</a></li>
                            <li><a href="{{ route('shop.index', ['sort' => 'price_asc']) }}" class="hover:text-white">Best Deals</a></li>
                            <li><a href="{{ route('shop.index', ['sort' => 'latest']) }}" class="hover:text-white">New Arrivals</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Account</h3>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            @auth
                                <li><a href="{{ route('orders.index') }}" class="hover:text-white">My Orders</a></li>
                                <li><a href="{{ route('cart.index') }}" class="hover:text-white">My Cart</a></li>
                            @else
                                <li><a href="{{ route('login') }}" class="hover:text-white">Sign in</a></li>
                                <li><a href="{{ route('register') }}" class="hover:text-white">Create account</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Contact</h3>
                        <ul class="mt-4 space-y-2.5 text-sm text-slate-400">
                            <li>hello@shop2.com</li>
                            <li>+1 (555) 123-4567</li>
                            <li>123 Market Street, New York, NY</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-slate-800 pt-8 text-sm text-slate-500 sm:flex-row">
                    <p>© {{ date('Y') }} Shop2. All rights reserved.</p>
                    <div class="flex items-center gap-4">
                        <span>Visa</span><span>Mastercard</span><span>PayPal</span><span>Cash on Delivery</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
