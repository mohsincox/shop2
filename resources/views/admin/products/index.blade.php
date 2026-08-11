<x-layouts.admin title="Products">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap gap-3">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-2">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Search products..."
                    class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <select name="category" onchange="this.form.submit()"
                    class="rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-bold text-white hover:bg-indigo-700">Filter</button>
            </form>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700">
            <span>&#43;</span> Add product
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-400">
                        <th class="px-6 py-3.5 font-bold">Product</th>
                        <th class="px-6 py-3.5 font-bold">Category</th>
                        <th class="px-6 py-3.5 font-bold">Price</th>
                        <th class="px-6 py-3.5 font-bold">Stock</th>
                        <th class="px-6 py-3.5 font-bold">Featured</th>
                        <th class="px-6 py-3.5 text-right font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $product->image ?: 'https://picsum.photos/seed/'.$product->slug.'/100/100' }}" alt="{{ $product->name }}"
                                        class="h-11 w-11 rounded-lg object-cover">
                                    <a href="{{ route('shop.show', $product->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-indigo-600">{{ $product->name }}</a>
                                </div>
                            </td>
                            <td class="px-6 py-3.5"><span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700">{{ $product->category?->name }}</span></td>
                            <td class="px-6 py-3.5 font-extrabold text-slate-900">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-3.5">
                                @if ($product->stock <= 5)
                                    <span class="font-bold text-amber-600">{{ $product->stock }} left</span>
                                @elseif ($product->stock > 0)
                                    <span class="font-bold text-emerald-600">{{ $product->stock }}</span>
                                @else
                                    <span class="font-bold text-rose-600">Out of stock</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5">
                                @if ($product->featured)
                                    <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700">&#9733; Featured</span>
                                @else
                                    <span class="text-slate-300">&ndash;</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-bold text-slate-600 transition hover:border-indigo-300 hover:text-indigo-600">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                        onsubmit="return confirm('Delete this product permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-bold text-rose-600 transition hover:bg-rose-50">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                <p class="text-4xl">&#128269;</p>
                                <p class="mt-3 font-semibold">No products found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
</x-layouts.admin>
