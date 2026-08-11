<x-layouts.admin :title="$product->exists ? __('Edit product') : __('Add product')">
    <div class="max-w-3xl">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="text-xl font-extrabold text-slate-900">{{ $product->exists ? __('Edit product') : __('Create a new product') }}</h2>
            <p class="mt-1 text-sm text-slate-500">{{ $product->exists ? __('Update the details of :name.', ['name' => $product->name]) : __('Fill in the details below to add a new product to your store.') }}</p>

            <form method="POST"
                action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
                class="mt-8 space-y-5">
                @csrf
                @if ($product->exists)
                    @method('PUT')
                @endif

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Product name") }}</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('name') border-rose-400 @enderror">
                        @error('name')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="category_id" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Category") }}</label>
                        <select id="category_id" name="category_id" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('category_id') border-rose-400 @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="price" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Price ($)") }}</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('price') border-rose-400 @enderror">
                        @error('price')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="stock" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Stock quantity") }}</label>
                        <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('stock') border-rose-400 @enderror">
                        @error('stock')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Description") }}</label>
                    <textarea id="description" name="description" rows="5" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('description') border-rose-400 @enderror"
                        placeholder="Describe the product, materials, features...">{{ old('description', $product->description) }}</textarea>
                    @error('description')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="image" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ __("Image URL") }} <span class="font-normal text-slate-400">({{ __('optional — a placeholder is used if empty') }})</span></label>
                    <input type="url" id="image" name="image" value="{{ old('image', $product->image) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 @error('image') border-rose-400 @enderror"
                        placeholder="https://example.com/image.jpg">
                    @error('image')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                </div>

                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-4 transition has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                    <input type="checkbox" name="featured" value="1" @checked(old('featured', $product->featured)) class="h-4 w-4 text-indigo-600">
                    <span>
                        <span class="block text-sm font-bold text-slate-900">&#9733; {{ __("Mark as featured") }}</span>
                        <span class="block text-xs text-slate-500">{{ __("Featured products appear on the homepage and get a discount badge.") }}</span>
                    </span>
                </label>

                <div class="flex items-center gap-3 border-t border-slate-100 pt-6">
                    <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700">
                        {{ $product->exists ? __('Save changes') : __('Create product') }}
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">{{ __("Cancel") }}</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
