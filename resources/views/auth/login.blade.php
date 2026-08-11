<x-layouts.app title="Sign in">
    <div class="relative flex min-h-[80vh] items-center justify-center px-4 py-16">
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-24 top-10 h-72 w-72 rounded-full bg-indigo-200/60 blur-3xl"></div>
            <div class="absolute -right-24 bottom-10 h-72 w-72 rounded-full bg-violet-200/60 blur-3xl"></div>
        </div>

        <div class="relative w-full max-w-md">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white/90 shadow-2xl backdrop-blur">
                <div class="bg-gradient-to-br from-indigo-600 to-violet-700 px-8 py-8 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-3xl backdrop-blur">🛍️</div>
                    <h1 class="mt-4 text-2xl font-extrabold text-white">Welcome back</h1>
                    <p class="mt-1 text-sm text-indigo-100">Sign in to continue shopping with us</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5 px-8 py-8">
                    @csrf

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('email') border-rose-400 @enderror"
                            placeholder="you@example.com">
                        @error('email')
                            <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-slate-600">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            Remember me
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:from-indigo-700 hover:to-violet-700">
                        Sign in
                    </button>

                    <p class="text-center text-sm text-slate-500">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Create one</a>
                    </p>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-slate-500">
                Demo admin account: <span class="font-semibold text-slate-700">admin@shop2.com</span> / <span class="font-semibold text-slate-700">password</span>
            </p>
        </div>
    </div>
</x-layouts.app>
