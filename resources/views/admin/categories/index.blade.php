<x-layouts.admin title="Categories">
    <div class="grid gap-8 lg:grid-cols-[360px_1fr]">
        {{-- Add category form --}}
        <div class="h-fit rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-extrabold text-slate-900">Add category</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Category name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('name') border-rose-400 @enderror">
                    @error('name')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="description" class="mb-1.5 block text-sm font-semibold text-slate-700">Description <span class="font-normal text-slate-400">(optional)</span></label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('description') }}</textarea>
                    @error('description')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="w-full rounded-xl bg-indigo-600 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700">
                    &#43; Add category
                </button>
            </form>
        </div>

        {{-- Categories list --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-4">
                <h2 class="font-extrabold text-slate-900">All categories</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-400">
                            <th class="px-6 py-3.5 font-bold">Name</th>
                            <th class="px-6 py-3.5 font-bold">Slug</th>
                            <th class="px-6 py-3.5 font-bold">Products</th>
                            <th class="px-6 py-3.5 text-right font-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-900">{{ $category->name }}</p>
                                    @if ($category->description)
                                        <p class="mt-0.5 line-clamp-1 max-w-xs text-xs text-slate-500">{{ $category->description }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ $category->slug }}</td>
                                <td class="px-6 py-4"><span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700">{{ $category->products_count }}</span></td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-edit-category="{{ $category->id }}"
                                            data-name="{{ $category->name }}" data-description="{{ $category->description }}"
                                            class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-600 transition hover:border-indigo-300 hover:text-indigo-600">Edit</button>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                            onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-bold text-rose-600 transition hover:bg-rose-50">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center text-slate-400">
                                    <p class="text-4xl">&#128193;</p>
                                    <p class="mt-3 font-semibold">No categories yet. Create your first one!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit modal --}}
    <div data-edit-modal class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4">
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">
            <h3 class="text-lg font-extrabold text-slate-900">Edit category</h3>
            <form method="POST" action="" data-edit-form class="mt-5 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Category name</label>
                    <input type="text" name="name" data-edit-name required
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Description</label>
                    <textarea name="description" rows="3" data-edit-description
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100"></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 rounded-xl bg-indigo-600 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700">Save changes</button>
                    <button type="button" data-edit-close class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const modal = document.querySelector('[data-edit-modal]');
            const form = document.querySelector('[data-edit-form]');

            document.querySelectorAll('[data-edit-category]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    form.action = btn.dataset.editCategory ? '{{ route('admin.categories.index') }}' + '/' + btn.dataset.editCategory : '';
                    form.querySelector('[data-edit-name]').value = btn.dataset.name;
                    form.querySelector('[data-edit-description]').value = btn.dataset.description;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            document.querySelector('[data-edit-close]').addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        </script>
    @endpush
</x-layouts.admin>
