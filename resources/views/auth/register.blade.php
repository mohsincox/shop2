<x-layouts.app title="Create account">
    <div class="relative flex min-h-[80vh] items-center justify-center px-4 py-16">
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-24 top-10 h-72 w-72 rounded-full bg-violet-200/60 blur-3xl"></div>
            <div class="absolute -right-24 bottom-10 h-72 w-72 rounded-full bg-indigo-200/60 blur-3xl"></div>
        </div>

        <div class="relative w-full max-w-md">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white/90 shadow-2xl backdrop-blur">
                <div class="bg-gradient-to-br from-violet-600 to-indigo-700 px-8 py-8 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-3xl backdrop-blur">🎉</div>
                    <h1 class="mt-4 text-2xl font-extrabold text-white">Create your account</h1>
                    <p class="mt-1 text-sm text-violet-100">Join Shop2 and start shopping today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5 px-8 py-8">
                    @csrf

                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Full name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('name') border-rose-400 @enderror"
                            placeholder="Jane Doe">
                        @error('name')
                            <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
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
                            placeholder="Minimum 8 characters">
                        @error('password')
                            <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 py-3 text-sm font-bold text-white shadow-lg shadow-violet-200 transition hover:from-violet-700 hover:to-indigo-700">
                        Create account
                    </button>

                    <p class="text-center text-sm text-slate-500">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
