<x-layout>
<x-navbar></x-navbar>

{{-- Hero Section --}}
<div class="bg-gradient-to-br from-emerald-600 via-emerald-700 to-emerald-800 relative overflow-hidden">
  <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 relative">
    <div class="text-center">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">Marketplace Pertanian</h1>
      <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Temukan berbagai produk pertanian berkualitas langsung dari petani lokal untuk mendukung kebutuhan Anda.</p>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('marketplace') }}" class="mt-8 max-w-2xl mx-auto">
      <div class="relative bg-white rounded-xl shadow-lg overflow-hidden border-2 border-white/20">
        <svg class="w-5 h-5 text-emerald-500 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
        </svg>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari produk, kategori, atau penjual..." 
          class="w-full pl-12 pr-24 py-4 border-0 focus:ring-0 text-gray-900 placeholder-gray-400 bg-transparent" />
        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-400 transition font-medium shadow-md">
          Cari
        </button>
      </div>
    </form>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
  {{-- Flash Messages --}}
  @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-center gap-3">
      <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span class="text-green-800">{{ session('success') }}</span>
    </div>
  @endif

  {{-- Filters --}}
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-8">
    <form method="GET" action="{{ route('marketplace') }}" class="flex flex-col lg:flex-row lg:items-center gap-4">
      {{-- Hidden search field to preserve search query --}}
      @if(request('q'))
        <input type="hidden" name="q" value="{{ request('q') }}">
      @endif

      {{-- Categories --}}
      <div class="flex-1">
        <label for="category" class="block text-xs font-medium text-gray-500 mb-1">Kategori</label>
        <select id="category" name="category" class="w-full rounded-lg border-gray-200 py-2.5 text-sm text-gray-700 focus:ring-emerald-500 focus:border-emerald-500">
          <option value="all">Semua Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->category_id }}" {{ (string)request('category') === (string)$cat->category_id ? 'selected' : '' }}>
              {{ ucfirst(str_replace('-', ' ', $cat->slug)) }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Price Range --}}
      <div class="flex items-end gap-2">
        <div>
          <label class="block text-xs font-medium text-gray-500 mb-1">Harga Min</label>
          <input type="number" name="min_price" placeholder="0" value="{{ request('min_price') }}" 
            class="w-28 rounded-lg border-gray-200 py-2.5 text-sm focus:ring-emerald-500 focus:border-emerald-500" />
        </div>
        <span class="text-gray-300 pb-2.5">—</span>
        <div>
          <label class="block text-xs font-medium text-gray-500 mb-1">Harga Max</label>
          <input type="number" name="max_price" placeholder="∞" value="{{ request('max_price') }}" 
            class="w-28 rounded-lg border-gray-200 py-2.5 text-sm focus:ring-emerald-500 focus:border-emerald-500" />
        </div>
      </div>

      {{-- Sort --}}
      <div>
        <label class="block text-xs font-medium text-gray-500 mb-1">Urutkan</label>
        <select name="sort" class="rounded-lg border-gray-200 py-2.5 text-sm text-gray-700 focus:ring-emerald-500 focus:border-emerald-500">
          <option value="">Terbaru</option>
          <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
          <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
          <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
        </select>
      </div>

      {{-- Filter Button --}}
      <div class="flex items-end gap-2">
        <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition font-medium text-sm">
          <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
          </svg>
          Filter
        </button>
        @if(request()->hasAny(['q', 'category', 'min_price', 'max_price', 'sort']))
          <a href="{{ route('marketplace') }}" class="px-4 py-2.5 text-gray-600 hover:text-gray-800 text-sm">Reset</a>
        @endif
      </div>
    </form>
  </div>

  {{-- Results Info --}}
  <div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-600">
      Menampilkan <span class="font-semibold text-gray-900">{{ $products->count() }}</span> dari 
      <span class="font-semibold text-gray-900">{{ $products->total() }}</span> produk
      @if(request('q'))
        untuk "<span class="font-semibold text-emerald-600">{{ request('q') }}</span>"
      @endif
    </p>
  </div>

  {{-- Product Grid --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($products as $product)
      @php
        $thumb = optional($product->images->first())->path ?? $product->image_url ?? null;
        $thumbUrl = $thumb ? (preg_match('/^https?:\/\//', $thumb) ? $thumb : asset(ltrim($thumb, '/'))) : 'https://images.unsplash.com/photo-1560493676-04071c5f467b?w=400&h=300&fit=crop';
      @endphp
      <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
        {{-- Image --}}
        <div class="relative aspect-[4/3] overflow-hidden">
          <img src="{{ $thumbUrl }}" alt="{{ $product->name }}" 
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
          
          {{-- Stock Badge --}}
          <div class="absolute top-3 left-3">
            @if($product->stock > 0)
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500 text-white shadow-sm">
                <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
                Tersedia
              </span>
            @else
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-500 text-white shadow-sm">
                Habis
              </span>
            @endif
          </div>

          {{-- Category Badge --}}
          @if($product->category)
            <div class="absolute top-3 right-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-white/90 text-gray-700 shadow-sm backdrop-blur-sm">
                {{ ucfirst(str_replace('-', ' ', $product->category->slug)) }}
              </span>
            </div>
          @endif

          {{-- Quick View Overlay --}}
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
            <a href="{{ route('marketplace.detail', $product->product_id) }}" 
              class="px-4 py-2 bg-white text-emerald-700 rounded-lg font-medium text-sm shadow-lg hover:bg-emerald-50 transition transform translate-y-4 group-hover:translate-y-0 duration-300">
              Lihat Detail
            </a>
          </div>
        </div>

        {{-- Content --}}
        <div class="p-4">
          {{-- Title --}}
          <h3 class="font-semibold text-gray-900 truncate group-hover:text-emerald-700 transition">
            {{ $product->name }}
          </h3>

          {{-- Rating & Reviews --}}
          <div class="mt-2 flex items-center gap-2">
            <div class="flex items-center">
              @for($i = 1; $i <= 5; $i++)
                <svg class="w-4 h-4 {{ $i <= ($product->rating ?? 4) ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/>
                </svg>
              @endfor
            </div>
            <span class="text-sm text-gray-500">({{ $product->reviews_count ?? 0 }})</span>
          </div>

          {{-- Location --}}
          <div class="mt-2 flex items-center text-sm text-gray-500">
            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="truncate">{{ $product->location ?? 'Lokasi tidak tersedia' }}</span>
          </div>

          {{-- Seller --}}
          <div class="mt-2 flex items-center text-sm text-gray-500">
            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="truncate">{{ $product->seller->name ?? 'Petani' }}</span>
          </div>

          {{-- Price Card --}}
          <div class="mt-4 p-3 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-100">
            <div class="flex items-baseline justify-between">
              <div>
                <span class="text-xs text-emerald-600 font-medium">Harga</span>
                <div class="text-xl font-bold text-emerald-700">
                  Rp {{ number_format($product->price, 0, ',', '.') }}
                  <span class="text-sm font-normal text-emerald-600">/ {{ $product->unit ?? 'kg' }}</span>
                </div>
              </div>
              <div class="text-right">
                <span class="text-xs text-gray-500">Stok</span>
                <div class="text-sm font-semibold text-gray-700">{{ number_format($product->stock ?? 0, 0, ',', '.') }} {{ $product->unit ?? 'kg' }}</div>
              </div>
            </div>
          </div>

          {{-- Action Button --}}
          <a href="{{ route('marketplace.detail', $product->product_id) }}" 
            class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl font-medium text-sm hover:bg-emerald-500 transition shadow-sm hover:shadow group">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Lihat Detail
          </a>
        </div>
      </div>
    @empty
      {{-- Empty State --}}
      <div class="col-span-full">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
          <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Produk tidak ditemukan</h3>
          <p class="text-gray-500 mb-6">Coba ubah filter pencarian Anda atau jelajahi kategori lain.</p>
          <a href="{{ route('marketplace') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Reset Filter
          </a>
        </div>
      </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  @if($products->hasPages())
    <div class="mt-8">
      {{ $products->links() }}
    </div>
  @endif
</div>

{{-- CTA Section for Farmers --}}
@auth
  @if((auth()->user()->role ?? '') === 'petani')
    <div class="bg-emerald-50 border-t border-emerald-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
          <div>
            <h3 class="text-lg font-semibold text-emerald-800">Ingin menjual produk Anda?</h3>
            <p class="text-emerald-600">Tambahkan produk ke marketplace dan jangkau lebih banyak pembeli.</p>
          </div>
          <a href="{{ route('dashboard.farmer.product.create') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-500 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
          </a>
        </div>
      </div>
    </div>
  @endif
@endauth

</x-layout>