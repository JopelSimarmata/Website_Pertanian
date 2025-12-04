<x-layout>
<x-navbar></x-navbar>

<div class="bg-gradient-to-br from-emerald-50 via-green-50 to-emerald-100 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    {{-- Flash Messages --}}
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg shadow-sm">
        <div class="flex items-center">
          <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span class="text-green-800 font-medium">{{ session('success') }}</span>
        </div>
      </div>
    @endif
    @if(session('error'))
      <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg shadow-sm">
        <div class="flex items-center">
          <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span class="text-red-800 font-medium">{{ session('error') }}</span>
        </div>
      </div>
    @endif

    {{-- Header --}}
    <div class="mb-8">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Petani</h1>
          <p class="text-gray-600">Selamat datang kembali, <span class="font-semibold text-emerald-700">{{ $user->name }}</span></p>
        </div>
        <div class="flex items-center gap-3">
          <a href="{{ route('marketplace') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Marketplace
          </a>
          <a href="{{ route('dashboard.farmer.product.create') }}" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-500 transition shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Produk
          </a>
        </div>
      </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      {{-- Total Products --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-blue-100 rounded-xl">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
          @if($stats['low_stock_products'] > 0)
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
              {{ $stats['low_stock_products'] }} stok rendah
            </span>
          @endif
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $stats['total_products'] }}</div>
        <div class="text-sm text-gray-500">Total Produk</div>
      </div>

      {{-- Total Stock --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-emerald-100 rounded-xl">
            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
            </svg>
          </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($stats['total_stock']) }}</div>
        <div class="text-sm text-gray-500">Total Stok</div>
      </div>

      {{-- Visit Requests --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-amber-100 rounded-xl">
            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
          </div>
          @if($stats['pending_requests'] > 0)
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700 animate-pulse">
              {{ $stats['pending_requests'] }} pending
            </span>
          @endif
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $stats['total_requests'] }}</div>
        <div class="text-sm text-gray-500">Permintaan Kunjungan</div>
      </div>

      {{-- Average Rating --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-yellow-100 rounded-xl">
            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"></path>
            </svg>
          </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($stats['avg_rating'], 1) }}</div>
        <div class="text-sm text-gray-500">Rating Rata-rata ({{ $stats['total_reviews'] }} ulasan)</div>
      </div>
    </div>


    {{-- Low Stock Alert --}}
    @if($stats['low_stock_products'] > 0)
      <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl shadow-sm">
        <div class="flex items-start">
          <svg class="w-6 h-6 text-red-500 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
          </svg>
          <div>
            <h3 class="text-red-800 font-semibold mb-1">Peringatan Stok Rendah!</h3>
            <p class="text-red-700 text-sm">{{ $stats['low_stock_products'] }} produk Anda memiliki stok di bawah 10. Segera perbarui stok Anda.</p>
          </div>
        </div>
      </div>
    @endif

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Products List --}}
    <div class="lg:col-span-2">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-bold text-gray-900">Produk Anda</h2>
          <span class="text-sm text-gray-500">{{ $products->count() }} produk</span>
        </div>
        <div class="space-y-4">
        @forelse($products as $p)
          @php
            $thumb = optional($p->images->first())->path ?? $p->image_url ?? 'https://images.unsplash.com/photo-1560493676-04071c5f467b?w=400&h=300&fit=crop';
            $thumbUrl = preg_match('/^https?:\/\//', $thumb) ? $thumb : asset(ltrim($thumb, '/'));
            $stockStatus = $p->stock < 10 ? 'low' : ($p->stock < 50 ? 'medium' : 'high');
          @endphp
          <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 hover:border-emerald-300 hover:shadow-md transition flex items-start gap-4">
            <div class="relative">
              <img src="{{ $thumbUrl }}" alt="{{ $p->name }}" class="w-24 h-24 object-cover rounded-lg shrink-0" />
              @if($stockStatus === 'low')
                <span class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                  </svg>
                </span>
              @endif
            </div>
            <div class="flex-1 min-w-0">
              <div class="font-semibold text-gray-900 mb-1">{{ $p->name }}</div>
              <div class="flex items-center gap-2 mb-2">
                <span class="text-lg font-bold text-emerald-600">Rp {{ number_format($p->price,0,',','.') }}</span>
                <span class="text-sm text-gray-500">/ {{ $p->unit ?? 'kg' }}</span>
              </div>
              <div class="flex items-center gap-3 text-sm">
                <span class="flex items-center gap-1 {{ $stockStatus === 'low' ? 'text-red-600' : 'text-gray-600' }}">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                  </svg>
                  Stok: {{ $p->stock }}
                </span>
                @if($p->rating)
                  <span class="flex items-center gap-1 text-yellow-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"></path>
                    </svg>
                    {{ number_format($p->rating, 1) }}
                  </span>
                @endif
              </div>
              @if($p->category)
                <span class="inline-block mt-2 px-2.5 py-1 text-xs bg-emerald-100 text-emerald-700 rounded-full font-medium">{{ ucfirst(str_replace('-', ' ', $p->category->slug)) }}</span>
              @endif
            </div>
            <div class="flex flex-col gap-2 shrink-0">
              <a href="{{ route('marketplace.detail', $p->product_id) }}" title="Lihat Detail" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
              </a>
              <a href="{{ route('dashboard.farmer.product.edit', $p->product_id) }}" title="Edit Produk" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </a>
              <form action="{{ route('dashboard.farmer.product.destroy', $p->product_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" title="Hapus Produk" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </form>
            </div>
          </div>
        @empty
          <div class="bg-gray-50 p-12 rounded-xl border-2 border-dashed border-gray-300 text-center">
            <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Produk</h3>
            <p class="text-gray-500 mb-4">Mulai jual produk pertanian Anda dengan menambahkan produk pertama</p>
            <a href="{{ route('dashboard.farmer.product.create') }}" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-500 transition shadow-lg">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              Tambah Produk Pertama
            </a>
          </div>
        @endforelse
      </div>
      </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="space-y-6">
      {{-- Visit Requests --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-bold text-gray-900">Permintaan Kunjungan</h2>
          @if($stats['pending_requests'] > 0)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-700 animate-pulse">
              {{ $stats['pending_requests'] }} pending
            </span>
          @endif
        </div>
      <div class="space-y-4">
        @forelse($recentRequests as $req)
          <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex items-start gap-3 mb-3">
              @php
                $buyerAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($req->user->name) . '&color=6366f1&background=e0e7ff';
              @endphp
              <img src="{{ $buyerAvatar }}" alt="{{ $req->user->name }}" class="w-10 h-10 rounded-full">
              <div class="flex-1 min-w-0">
                <div class="font-semibold text-gray-900">{{ $req->user->name }}</div>
                <div class="text-sm text-gray-500">{{ $req->user->email }}</div>
              </div>
              @if($req->status === 'pending' || $req->status === null)
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                  Pending
                </span>
              @elseif($req->status === 'approved')
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                  Disetujui
                </span>
              @elseif($req->status === 'rejected')
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                  Ditolak
                </span>
              @endif
            </div>
            <div class="space-y-1 text-sm text-gray-600 mb-3">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <span class="font-medium">{{ $req->product->name ?? '-' }}</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>{{ \Carbon\Carbon::parse($req->visit_date)->format('d M Y') }} - {{ substr($req->visit_time, 0, 5) }}</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
                <span>{{ $req->quantity }} {{ $req->product->unit ?? 'kg' }}</span>
              </div>
            </div>
            @if($req->status === 'pending' || $req->status === null)
              <div class="flex gap-2">
                <form action="{{ route('visit_requests.approve', $req->request_id) }}" method="POST" class="flex-1">
                  @csrf
                  <button type="submit" class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition text-sm font-medium">
                    Setujui
                  </button>
                </form>
                <form action="{{ route('visit_requests.reject', $req->request_id) }}" method="POST" class="flex-1">
                  @csrf
                  <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500 transition text-sm font-medium">
                    Tolak
                  </button>
                </form>
              </div>
            @endif
          </div>
        @empty
          <div class="bg-gray-50 p-8 rounded-xl border-2 border-dashed border-gray-300 text-center">
            <div class="w-12 h-12 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            </div>
            <p class="text-gray-500 text-sm">Belum ada permintaan kunjungan</p>
          </div>
        @endforelse
      </div>
      </div>

      {{-- Top Products --}}
      @if($topProducts->count() > 0 && $topProducts->first()->rating)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Produk Terbaik</h3>
          <div class="space-y-3">
            @foreach($topProducts->take(3) as $top)
              <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg border border-amber-100">
                @php
                  $topThumb = optional($top->images->first())->path ?? $top->image_url ?? 'https://images.unsplash.com/photo-1560493676-04071c5f467b?w=100&h=100&fit=crop';
                  $topThumbUrl = preg_match('/^https?:\/\//', $topThumb) ? $topThumb : asset(ltrim($topThumb, '/'));
                @endphp
                <img src="{{ $topThumbUrl }}" alt="{{ $top->name }}" class="w-12 h-12 object-cover rounded-lg">
                <div class="flex-1 min-w-0">
                  <div class="font-medium text-gray-900 text-sm truncate">{{ $top->name }}</div>
                  <div class="flex items-center gap-1 text-yellow-600 text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"></path>
                    </svg>
                    {{ number_format($top->rating, 1) }}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>

  {{-- Quick Actions --}}
  <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <a href="{{ route('dashboard.farmer.product.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-200 hover:shadow-md transition">
        <div class="p-3 bg-emerald-600 rounded-xl">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
        </div>
        <div>
          <div class="font-semibold text-gray-900">Tambah Produk</div>
          <div class="text-sm text-gray-600">Tambahkan produk baru ke toko</div>
        </div>
      </a>

      <a href="{{ route('visit_requests.index') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200 hover:shadow-md transition">
        <div class="p-3 bg-blue-600 rounded-xl">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
        </div>
        <div>
          <div class="font-semibold text-gray-900">Lihat Semua Permintaan</div>
          <div class="text-sm text-gray-600">Kelola permintaan kunjungan</div>
        </div>
      </a>

      <a href="{{ route('marketplace') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-xl border border-amber-200 hover:shadow-md transition">
        <div class="p-3 bg-amber-600 rounded-xl">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
        </div>
        <div>
          <div class="font-semibold text-gray-900">Kunjungi Marketplace</div>
          <div class="text-sm text-gray-600">Lihat produk di marketplace</div>
        </div>
      </a>
    </div>
  </div>

</div>
</div>

</x-layout>
