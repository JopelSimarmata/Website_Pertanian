<x-layout>

<x-navbar></x-navbar>

  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-emerald-800">Marketplace</h1>
      @auth
      <a href="/marketplace/add" class="inline-block rounded-md bg-emerald-600 text-white px-4 py-2 hover:bg-emerald-500">Tambah Produk</a>
      @endauth
    </div>

    @if(session('success'))
      <div class="mb-4 rounded-md bg-green-50 p-3 text-green-800">{{ session('success') }}</div>
    @endif

    @if(isset($products) && $products->isEmpty())
      <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-500">
        Belum ada produk di marketplace.
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products ?? [] as $product)
          <article class="bg-white rounded-xl shadow p-4 flex flex-col">
            <a href="/marketplace/{{ $product->id }}" class="block overflow-hidden rounded-md bg-gray-100">
              <img src="{{ $product->image_url ?? asset('image/placeholder.png') }}" alt="{{ $product->title }}" class="w-full h-48 object-cover" />
            </a>

            <div class="mt-3 flex-1">
              <a href="/marketplace/{{ $product->id }}" class="text-lg font-semibold text-emerald-800 hover:underline">{{ $product->title }}</a>
              <div class="mt-1 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 120) }}</div>
            </div>

            <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
              <div>
                <div class="text-emerald-700 font-semibold">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</div>
                <div class="text-xs text-gray-400">Penjual: {{ $product->seller_name ?? ($product->user->name ?? 'Penjual') }}</div>
              </div>
              <div>
                <a href="/marketplace/{{ $product->id }}" class="inline-block rounded-md bg-emerald-600 text-white px-3 py-1.5 hover:bg-emerald-500">Lihat</a>
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-3 rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-500">Tidak ada produk ditemukan.</div>
        @endforelse
      </div>
    @endif
  </div>
</x-layout>
