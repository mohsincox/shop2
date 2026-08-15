@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title.' · ' : '' }}Admin · {{ config('app.name', 'Shop') }}</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>%E2%9A%99%EF%B8%8F</text></svg>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-100 font-sans text-slate-800 antialiased">
    <div class="flex min-h-full">

        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 transform flex-col bg-slate-900 transition-transform lg:flex">
            <div class="flex h-16 items-center gap-2 border-b border-slate-800 px-6">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-lg">&#128722;</span>
                <div>
                    <p class="text-base font-extrabold tracking-tight text-white">Shop<span class="text-indigo-400">2</span></p>
                    <p class="-mt-0.5 text-[10px] font-bold uppercase tracking-widest text-slate-500">{{ __('Admin panel') }}</p>
                </div>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold">
                    <span class="text-base">&#128200;</span> {{ __('Dashboard') }}
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="{{ request()->routeIs('admin.products.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold">
                    <span class="text-base">&#127873;</span> {{ __('Products') }}
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="{{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold">
                    <span class="text-base">&#128193;</span> {{ __('Categories') }}
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="{{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold">
                    <span class="text-base">&#128230;</span> {{ __('Orders') }}
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold">
                    <span class="text-base">&#128101;</span> {{ __('Customers') }}
                </a>
            </nav>

            <div class="border-t border-slate-800 p-4">
                <div class="flex items-center gap-3 rounded-xl bg-slate-800/60 px-3 py-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-xs font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('home') }}" class="flex-1 rounded-lg bg-slate-800 py-2 text-center text-xs font-bold text-slate-300 transition hover:bg-slate-700 hover:text-white">
                        {{ __('View store') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full rounded-lg bg-rose-600/90 py-2 text-xs font-bold text-white transition hover:bg-rose-600">
                            {{ __('Sign out') }}
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Mobile top bar --}}
        <div class="fixed inset-x-0 top-0 z-40 flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 lg:hidden">
            <div class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 text-sm">&#128722;</span>
                <span class="font-extrabold tracking-tight text-slate-900">Shop<span class="text-indigo-600">2</span> {{ __('Admin') }}</span>
            </div>
            <button type="button" data-admin-menu-toggle class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        {{-- Mobile nav --}}
        <div data-admin-menu class="fixed inset-x-0 top-16 z-40 hidden border-b border-slate-200 bg-white p-3 shadow-xl lg:hidden">
            <nav class="grid grid-cols-2 gap-2">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700' }} rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">{{ __('Dashboard') }}</a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700' }} rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">{{ __('Products') }}</a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700' }} rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">{{ __('Categories') }}</a>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700' }} rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">{{ __('Orders') }}</a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700' }} rounded-xl px-4 py-3 text-sm font-semibold hover:bg-slate-50">{{ __('Customers') }}</a>
                <a href="{{ route('home') }}" class="rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">{{ __('View store') }}</a>
            </nav>
        </div>

        {{-- Main --}}
        <div class="flex min-h-full flex-1 flex-col lg:pl-64">
            {{-- Header --}}
            <header class="sticky top-0 z-30 hidden h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-8 backdrop-blur lg:flex">
                <div>
                    <h1 class="text-lg font-extrabold text-slate-900">{{ $title ?? __('Dashboard') }}</h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative" data-dropdown>
                        <button type="button" data-dropdown-toggle
                            class="inline-flex h-9 items-center gap-1.5 rounded-full border border-slate-300 px-3 text-xs font-bold text-slate-600 transition hover:bg-slate-50"
                            aria-label="{{ __('Language') }}">
                            <span>🌐</span>
                            <span class="uppercase">{{ app()->getLocale() === 'de' ? 'DE' : 'EN' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div data-dropdown-menu class="absolute right-0 top-11 z-50 hidden w-40 overflow-hidden rounded-xl border border-slate-200 bg-white py-1.5 shadow-lg">
                            <a href="{{ route('language.switch', 'en') }}"
                                class="{{ app()->getLocale() === 'en' ? 'bg-indigo-50 font-bold text-indigo-700' : 'text-slate-700' }} flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50">
                                🇬🇧 {{ __('English') }}
                            </a>
                            <a href="{{ route('language.switch', 'de') }}"
                                class="{{ app()->getLocale() === 'de' ? 'bg-indigo-50 font-bold text-indigo-700' : 'text-slate-700' }} flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50">
                                🇩🇪 {{ __('Deutsch') }}
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('shop.index') }}" class="rounded-full border border-slate-300 px-4 py-1.5 text-xs font-bold text-slate-600 transition hover:bg-slate-50">
                        {{ __('View store') }}
                    </a>
                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-700">{{ __('Admin') }}</span>
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

            <main class="flex-1 px-4 py-8 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>

            <footer class="border-t border-slate-200 bg-white px-8 py-4 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} Shop. {{ __('All rights reserved.') }}
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
