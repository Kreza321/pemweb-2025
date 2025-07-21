<div class="container py-4">
    <div class="flex justify-between mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Cari produk..." class="border p-2 rounded w-1/3" />

        <select wire:model="category" class="border p-2 rounded">
            <option value="">Semua Kategori</option>
            @foreach (\App\Models\Category::all() as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($products as $product)
            <div class="border p-3 rounded shadow">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover mb-2">
                <h3 class="font-semibold">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600">Rp {{ number_format($product->price) }}</p>
            </div>
        @empty
            <p>Tidak ada produk ditemukan.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>