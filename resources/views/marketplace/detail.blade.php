<x-layout>
<x-navbar></x-navbar>

@php
  $images = $product->images->pluck('path')->toArray() ?? [];
  if (empty($images) && !empty($product->image_url)) {
      $images = [$product->image_url];
  }
  if (empty($images)) {
      $images = ['https://images.unsplash.com/photo-1560493676-04071c5f467b?w=800&h=600&fit=crop'];
  }
  // Convert paths to full URLs
  $images = array_map(function($img) {
      return preg_match('/^https?:\/\//', $img) ? $img : asset(ltrim($img, '/'));
  }, $images);
@endphp

<div class="bg-gradient-to-b from-emerald-50 to-white min-h-screen">
  {{-- Flash Messages --}}
  @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-4">
      <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 flex items-center gap-3">
        <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-green-800">{{ session('success') }}</span>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-4">
      <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 flex items-center gap-3">
        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-red-800">{{ session('error') }}</span>
      </div>
    </div>
  @endif

  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
      {{-- Left: Image Gallery --}}
      <div>
        <div id="product-carousel" class="sticky top-8">
          {{-- Main Image --}}
          <div class="relative bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
            <img id="main-image" src="{{ $images[0] }}" alt="{{ $product->name }}" 
              class="w-full aspect-square object-cover" />
            
            @if(count($images) > 1)
              <button id="prev" aria-label="Previous" 
                class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg text-gray-700 hover:text-emerald-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
              </button>
              <button id="next" aria-label="Next" 
                class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg text-gray-700 hover:text-emerald-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </button>
            @endif

            {{-- Stock Badge --}}
            <div class="absolute top-4 left-4">
              @if($product->stock > 0)
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-500 text-white shadow">
                  <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                  Stok Tersedia
                </span>
              @else
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-500 text-white shadow">
                  Stok Habis
                </span>
              @endif
            </div>

            {{-- Image Counter --}}
            @if(count($images) > 1)
              <div class="absolute bottom-4 right-4 px-3 py-1 bg-black/50 rounded-full text-white text-sm backdrop-blur-sm">
                <span id="image-counter">1</span> / {{ count($images) }}
              </div>
            @endif
          </div>

          {{-- Thumbnails --}}
          @if(count($images) > 1)
            <div class="mt-4 flex gap-3 overflow-x-auto pb-2">
              @foreach($images as $idx => $img)
                <button type="button" class="thumbnail shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 border-transparent hover:border-emerald-400 transition {{ $idx === 0 ? 'ring-2 ring-emerald-500' : '' }}" data-index="{{ $idx }}">
                  <img src="{{ $img }}" class="w-full h-full object-cover" alt="Thumbnail {{ $idx + 1 }}" />
                </button>
              @endforeach
            </div>
          @endif

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const images = @json($images);
              let idx = 0;
              const main = document.getElementById('main-image');
              const prev = document.getElementById('prev');
              const next = document.getElementById('next');
              const thumbs = document.querySelectorAll('#product-carousel .thumbnail');
              const counter = document.getElementById('image-counter');

              function setActiveThumb(i) {
                thumbs.forEach(t => t.classList.remove('ring-2','ring-emerald-500'));
                if (thumbs[i]) thumbs[i].classList.add('ring-2','ring-emerald-500');
              }

              function show(i) {
                idx = ((i % images.length) + images.length) % images.length;
                main.src = images[idx];
                setActiveThumb(idx);
                if (counter) counter.textContent = idx + 1;
              }

              if (prev) prev.addEventListener('click', function(){ show(idx - 1); });
              if (next) next.addEventListener('click', function(){ show(idx + 1); });

              thumbs.forEach(btn => {
                btn.addEventListener('click', function(){ show(parseInt(this.dataset.index)); });
              });

              show(0);
            });
          </script>
        </div>
      </div>

      {{-- Right: Product Info --}}
      <div>
        {{-- Category Badge --}}
        @if($product->category)
          <a href="{{ route('marketplace', ['category' => $product->category->category_id]) }}" 
            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition mb-4">
            {{ ucfirst(str_replace('-', ' ', $product->category->slug)) }}
          </a>
        @endif

        {{-- Product Title --}}
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

        {{-- Rating & Reviews --}}
        <div class="mt-4 flex items-center gap-4">
          <div class="flex items-center gap-1">
            @for($i = 1; $i <= 5; $i++)
              <svg class="w-5 h-5 {{ $i <= ($product->calculated_rating ?? $product->rating ?? 0) ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/>
              </svg>
            @endfor
            <span class="ml-2 text-lg font-semibold text-gray-900">{{ $product->calculated_rating ?? $product->rating ?? '0.0' }}</span>
          </div>
          <span class="text-gray-300">|</span>
          <a href="#reviews" class="text-emerald-600 hover:text-emerald-700 font-medium">{{ $product->reviews_count ?? 0 }} ulasan</a>
        </div>

        {{-- Price Card --}}
        <div class="mt-6 p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl border border-emerald-100">
          <div class="flex items-center justify-between">
            <div>
              <span class="text-sm text-emerald-600 font-medium">Harga Petani</span>
              <div class="mt-1 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-emerald-700">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                <span class="text-lg text-emerald-600">/ {{ $product->unit ?? 'kg' }}</span>
              </div>
            </div>
            <div class="text-right">
              <span class="text-sm text-gray-500">Stok Tersedia</span>
              <div class="mt-1 text-xl font-bold text-gray-900">{{ number_format($product->stock ?? 0, 0, ',', '.') }} {{ $product->unit ?? 'kg' }}</div>
            </div>
          </div>
        </div>

        {{-- Seller Info --}}
        <div class="mt-6 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
          <div class="flex items-center gap-4">
            @php
              $sellerAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($product->seller->name ?? 'P') . '&color=047857&background=d1fae5';
            @endphp
            <img src="{{ $sellerAvatar }}" alt="{{ $product->seller->name ?? 'Petani' }}" class="w-14 h-14 rounded-full border-2 border-emerald-100">
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-2">
                <h3 class="font-semibold text-gray-900 truncate">{{ $product->seller->name ?? 'Petani' }}</h3>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                  <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                  </svg>
                  Terverifikasi
                </span>
              </div>
              <p class="text-sm text-gray-500">{{ $product->farmer_email ?? $product->seller->email ?? '-' }}</p>
            </div>
          </div>
        </div>

        {{-- Location Info --}}
        <div class="mt-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
          <div class="flex items-start gap-3">
            <div class="p-2 bg-emerald-100 rounded-lg">
              <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <h4 class="font-medium text-gray-900">Lokasi Kebun</h4>
              <p class="text-gray-600">{{ $product->location ?? 'Lokasi tidak tersedia' }}</p>
              @if($product->detail_address)
                <p class="text-sm text-gray-500 mt-1">{{ $product->detail_address }}</p>
              @endif
            </div>
          </div>
        </div>

        {{-- Contact Info --}}
        @if($product->farmer_phone)
          <div class="mt-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="flex items-start gap-3">
              <div class="p-2 bg-emerald-100 rounded-lg">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
              </div>
              <div>
                <h4 class="font-medium text-gray-900">Kontak Petani</h4>
                <p class="text-gray-600">{{ $product->farmer_phone }}</p>
              </div>
            </div>
          </div>
        @endif

        {{-- Action Buttons --}}
        <div class="mt-6 space-y-3">
          @auth
            @if((auth()->user()->role ?? '') === 'tengkulak')
              <a href="{{ route('visit_requests.create', ['product_id' => $product->product_id]) }}" 
                class="w-full inline-flex items-center justify-center px-6 py-4 bg-emerald-600 text-white rounded-xl font-semibold text-lg hover:bg-emerald-500 transition shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Ajukan Kunjungan ke Kebun
              </a>
              <p class="text-center text-sm text-gray-500">Kunjungi langsung kebun petani untuk melihat kualitas produk</p>
            @elseif((auth()->user()->role ?? '') === 'petani' && auth()->user()->id === $product->seller_id)
              <a href="{{ route('dashboard.farmer.product.edit', $product->product_id) }}" 
                class="w-full inline-flex items-center justify-center px-6 py-4 bg-blue-600 text-white rounded-xl font-semibold text-lg hover:bg-blue-500 transition shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Produk Ini
              </a>
            @else
              <div class="text-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-gray-600">Hanya tengkulak yang dapat mengajukan kunjungan.</p>
              </div>
            @endif
          @else
            <a href="{{ route('show.login') }}" 
              class="w-full inline-flex items-center justify-center px-6 py-4 bg-emerald-600 text-white rounded-xl font-semibold text-lg hover:bg-emerald-500 transition shadow-lg">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
              </svg>
              Login untuk Mengajukan Kunjungan
            </a>
          @endauth

          <a href="{{ route('marketplace') }}" 
            class="w-full inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Marketplace
          </a>
        </div>
      </div>
    </div>

    {{-- Product Description & Reviews --}}
    <div class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
      {{-- Left: Description & Reviews --}}
      <div class="lg:col-span-2 space-y-6">
        {{-- Description --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Produk</h2>
          <div class="prose prose-emerald max-w-none text-gray-600">
            {!! nl2br(e($product->description ?? 'Deskripsi produk belum tersedia.')) !!}
          </div>
        </div>

        {{-- Product Features --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Keunggulan Produk</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="flex items-start gap-3">
              <div class="p-2 bg-emerald-100 rounded-lg shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <div>
                <h4 class="font-medium text-gray-900">Langsung dari Petani</h4>
                <p class="text-sm text-gray-500">Produk segar langsung dari kebun</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="p-2 bg-emerald-100 rounded-lg shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <div>
                <h4 class="font-medium text-gray-900">Harga Terbaik</h4>
                <p class="text-sm text-gray-500">Tanpa perantara, harga lebih murah</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="p-2 bg-emerald-100 rounded-lg shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <div>
                <h4 class="font-medium text-gray-900">Kunjungan Kebun</h4>
                <p class="text-sm text-gray-500">Bisa kunjungi lokasi sebelum beli</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="p-2 bg-emerald-100 rounded-lg shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <div>
                <h4 class="font-medium text-gray-900">Kualitas Terjamin</h4>
                <p class="text-sm text-gray-500">Petani terverifikasi</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Reviews Section --}}
        <div id="reviews" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">Ulasan Pembeli</h2>
            <span class="text-sm text-gray-500">{{ $product->reviews_count }} ulasan</span>
          </div>

          {{-- Rating Summary --}}
          @if($product->reviews_count > 0)
            <div class="mb-8 p-6 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl border border-amber-100">
              <div class="flex flex-col md:flex-row gap-6 items-center">
                {{-- Average Rating --}}
                <div class="text-center">
                  <div class="text-5xl font-bold text-gray-900 mb-2">{{ $product->calculated_rating ?? '0.0' }}</div>
                  <div class="flex items-center justify-center gap-1 mb-2">
                    @for($i = 1; $i <= 5; $i++)
                      <svg class="w-5 h-5 {{ $i <= round($product->calculated_rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/>
                      </svg>
                    @endfor
                  </div>
                  <div class="text-sm text-gray-600">dari {{ $product->reviews_count }} ulasan</div>
                </div>

                {{-- Rating Distribution --}}
                <div class="flex-1 w-full space-y-2">
                  @foreach($ratingDistribution as $star => $data)
                    <div class="flex items-center gap-3">
                      <div class="flex items-center gap-1 w-16">
                        <span class="text-sm font-medium text-gray-700">{{ $star }}</span>
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/>
                        </svg>
                      </div>
                      <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-amber-400" style="width: {{ $data['percentage'] }}%"></div>
                      </div>
                      <span class="text-sm text-gray-600 w-12 text-right">{{ $data['count'] }}</span>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          @endif

          {{-- Write Review Form --}}
          @auth
            @if($canReview)
              <div class="mb-8 p-6 bg-emerald-50 rounded-xl border border-emerald-200">
                <h3 class="font-semibold text-gray-900 mb-4">Tulis Ulasan Anda</h3>
                <form action="{{ route('marketplace.review.store', $product->product_id) }}" method="POST">
                  @csrf
                  {{-- Rating Stars --}}
                  <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <div class="flex gap-2">
                      @for($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer">
                          <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                          <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-300 transition" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/>
                          </svg>
                        </label>
                      @endfor
                    </div>
                  </div>

                  {{-- Comment --}}
                  <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
                    <textarea name="comment" rows="4" placeholder="Bagikan pengalaman Anda dengan produk ini..." 
                      class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                  </div>

                  <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition font-medium">
                    Kirim Ulasan
                  </button>
                </form>
              </div>
            @elseif($hasReviewed)
              <div class="mb-8 p-4 bg-blue-50 rounded-xl border border-blue-200">
                <div class="flex items-center gap-3">
                  <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                  <span class="text-blue-800">Anda sudah memberikan ulasan untuk produk ini</span>
                </div>
              </div>
            @elseif((auth()->user()->role ?? '') === 'tengkulak' && !$hasCompletedTransaction)
              <div class="mb-8 p-4 bg-amber-50 rounded-xl border border-amber-200">
                <div class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                  </svg>
                  <div>
                    <p class="text-amber-800 font-medium">Anda belum bisa memberikan ulasan</p>
                    <p class="text-sm text-amber-700 mt-1">Ulasan hanya dapat diberikan setelah kunjungan Anda disetujui oleh petani</p>
                  </div>
                </div>
              </div>
            @endif
          @else
            <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
              <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-gray-700">
                  <a href="{{ route('show.login') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">Login</a> untuk memberikan ulasan
                </span>
              </div>
            </div>
          @endauth

          {{-- Reviews List --}}
          <div class="space-y-4">
            @forelse($product->reviews->sortByDesc('created_at') as $review)
              <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                <div class="flex items-start gap-4">
                  @php
                    $reviewerAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($review->buyer->name ?? 'U') . '&color=6366f1&background=e0e7ff';
                  @endphp
                  <img src="{{ $reviewerAvatar }}" alt="{{ $review->buyer->name ?? 'User' }}" class="w-12 h-12 rounded-full">
                  <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-2">
                      <div>
                        <h4 class="font-semibold text-gray-900">{{ $review->buyer->name ?? 'Pembeli' }}</h4>
                        <div class="flex items-center gap-2 mt-1">
                          <div class="flex items-center gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                              <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/>
                              </svg>
                            @endfor
                          </div>
                          <span class="text-sm text-gray-500">• {{ $review->created_at->diffForHumans() }}</span>
                        </div>
                      </div>
                    </div>
                    @if($review->comment)
                      <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                    @endif
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center py-8">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <p class="text-gray-500">Belum ada ulasan untuk produk ini</p>
                <p class="text-sm text-gray-400 mt-1">Jadilah yang pertama memberikan ulasan!</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>

      {{-- Right Sidebar --}}
      <div>
        {{-- How it Works --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Cara Membeli</h3>
          <div class="space-y-4">
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0 text-emerald-700 font-bold text-sm">1</div>
              <div>
                <h4 class="font-medium text-gray-900">Ajukan Kunjungan</h4>
                <p class="text-sm text-gray-500">Pilih tanggal untuk mengunjungi kebun</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0 text-emerald-700 font-bold text-sm">2</div>
              <div>
                <h4 class="font-medium text-gray-900">Tunggu Persetujuan</h4>
                <p class="text-sm text-gray-500">Petani akan menyetujui permintaan Anda</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0 text-emerald-700 font-bold text-sm">3</div>
              <div>
                <h4 class="font-medium text-gray-900">Kunjungi Kebun</h4>
                <p class="text-sm text-gray-500">Lihat langsung kualitas produk</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0 text-emerald-700 font-bold text-sm">4</div>
              <div>
                <h4 class="font-medium text-gray-900">Lakukan Pembayaran</h4>
                <p class="text-sm text-gray-500">Bayar setelah puas dengan kualitas</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Share --}}
        <div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Bagikan Produk</h3>
          <div class="flex items-center gap-3">
            <a href="https://wa.me/?text={{ urlencode($product->name . ' - ' . url()->current()) }}" target="_blank" 
              class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" 
              class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>
            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link berhasil disalin!');" 
              class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 hover:bg-gray-300 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</x-layout>