<x-layout>
<x-navbar></x-navbar>

<div class="min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header Section --}}
    <div class="mb-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">Dashboard Petani</h1>
          <p class="mt-1 text-gray-600">Selamat datang kembali, <span class="font-semibold text-emerald-600">{{ $user->name }}</span></p>
        </div>
        <a href="{{ route('dashboard.farmer.product.create') }}" class="inline-flex items-center justify-center px-5 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition shadow-lg hover:shadow-xl font-medium">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Tambah Produk Baru
        </a>
      </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
      <div class="mb-6 p-4 rounded-xl bg-emerald-50 border-l-4 border-emerald-500 flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
      </div>
    @endif
    @if(session('error'))
      <div class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 flex items-start gap-3">
        <svg class="w-5 h-5 text-red-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-red-800 font-medium">{{ session('error') }}</p>
      </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      {{-- Total Products --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600">Total Produk</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Produk aktif</p>
          </div>
          <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
        </div>
      </div>

      {{-- Total Stock --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600">Total Stok</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->sum('stock') }}</p>
            <p class="text-xs text-gray-500 mt-1">Unit tersedia</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
            </svg>
          </div>
        </div>
      </div>

      {{-- Pending Requests --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600">Permintaan</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $requests->where('status', 'pending')->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Menunggu persetujuan</p>
          </div>
          <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      {{-- Total Requests --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600">Total Kunjungan</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $requests->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Semua permintaan</p>
          </div>
          <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>


    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      {{-- Products Section (2 columns) --}}
      <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h2 class="text-xl font-bold text-gray-900">Produk Anda</h2>
              <p class="text-sm text-gray-500 mt-1">Kelola dan pantau semua produk</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">
              {{ $products->count() }} Produk
            </span>
          </div>

          <div class="space-y-4">
            @forelse($products as $p)
              @php
                $thumb = optional($p->images->first())->path ?? $p->image_url ?? 'https://images.unsplash.com/photo-1560493676-04071c5f467b?w=400&h=300&fit=crop';
                $thumbUrl = preg_match('/^https?:\/\//', $thumb) ? $thumb : asset(ltrim($thumb, '/'));
                $stockStatus = $p->stock < 10 ? 'low' : ($p->stock < 50 ? 'medium' : 'high');
              @endphp
              <div class="group bg-gray-50 rounded-xl border border-gray-200 p-4 hover:border-emerald-300 hover:shadow-md transition">
                <div class="flex items-start gap-4">
                  {{-- Product Image --}}
                  <div class="relative shrink-0">
                    <img src="{{ $thumbUrl }}" alt="{{ $p->name }}" class="w-24 h-24 object-cover rounded-lg" />
                    @if($stockStatus === 'low')
                      <span class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                      </span>
                    @endif
                  </div>

                  {{-- Product Info --}}
                  <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-900 text-lg mb-1">{{ $p->name }}</h3>
                    <div class="flex items-center gap-3 mb-2">
                      <span class="text-xl font-bold text-emerald-600">Rp {{ number_format($p->price,0,',','.') }}</span>
                      <span class="text-sm text-gray-500">/ {{ $p->unit ?? 'kg' }}</span>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                      <span class="flex items-center gap-1.5 {{ $stockStatus === 'low' ? 'text-red-600' : 'text-gray-600' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        <span class="font-medium">Stok: {{ $p->stock }}</span>
                      </span>
                      @if($p->category)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                          {{ ucfirst(str_replace('-', ' ', $p->category->slug)) }}
                        </span>
                      @endif
                    </div>
                  </div>

                  {{-- Actions --}}
                  <div class="flex flex-col gap-2 shrink-0">
                    <a href="{{ route('marketplace.detail', $p->product_id) }}" class="p-2 text-gray-600 hover:bg-gray-200 rounded-lg transition" title="Lihat Detail">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                      </svg>
                    </a>
                    <a href="{{ route('dashboard.farmer.product.edit', $p->product_id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit Produk">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                      </svg>
                    </a>
                    <form action="{{ route('dashboard.farmer.product.destroy', $p->product_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus Produk">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                  </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Produk</h3>
                <p class="text-gray-500 mb-4">Mulai jual produk pertanian Anda dengan menambahkan produk pertama</p>
                <a href="{{ route('dashboard.farmer.product.create') }}" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition shadow-lg font-medium">
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

      {{-- Visit Requests Section (1 column) --}}
      <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h2 class="text-xl font-bold text-gray-900">Permintaan Kunjungan</h2>
              <p class="text-sm text-gray-500 mt-1">Kelola kunjungan pembeli</p>
            </div>
            @if($requests->where('status', 'pending')->count() > 0)
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700 animate-pulse">
                {{ $requests->where('status', 'pending')->count() }} Pending
              </span>
            @endif
          </div>

          <div class="space-y-4 max-h-[600px] overflow-y-auto">
            @forelse($requests as $req)
              <div class="bg-gray-50 rounded-xl border border-gray-200 p-4">
                <div class="flex items-start gap-3 mb-3">
                  @php
                    $buyerAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($req->user->name) . '&color=6366f1&background=e0e7ff';
                  @endphp
                  <img src="{{ $buyerAvatar }}" alt="{{ $req->user->name }}" class="w-10 h-10 rounded-full">
                  <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 text-sm">{{ $req->user->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $req->user->email }}</p>
                  </div>
                  @if($req->status === 'pending' || $req->status === null)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                      Pending
                    </span>
                  @elseif($req->status === 'approved')
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                      Disetujui
                    </span>
                  @else
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                      Ditolak
                    </span>
                  @endif
                </div>

                <div class="space-y-2 text-sm mb-3">
                  <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="font-medium truncate">{{ $req->product->name ?? '-' }}</span>
                  </div>
                  <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($req->visit_date)->format('d M Y') }} • {{ substr($req->visit_time, 0, 5) }}</span>
                  </div>
                  <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                    <span>{{ $req->quantity }} {{ $req->product->unit ?? 'kg' }}</span>
                  </div>
                </div>

                @if($req->status === 'pending' || $req->status === null)
                  <div class="flex gap-2">
                    <form action="{{ route('visit_requests.approve', $req->request_id) }}" method="POST" class="flex-1">
                      @csrf
                      <button type="submit" class="w-full px-3 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                        Setujui
                      </button>
                    </form>
                    <form action="{{ route('visit_requests.reject', $req->request_id) }}" method="POST" class="flex-1">
                      @csrf
                      <button type="submit" class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">
                        Tolak
                      </button>
                    </form>
                  </div>
                @endif
              </div>
            @empty
              <div class="text-center py-8">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                  <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <p class="text-gray-500 text-sm">Belum ada permintaan kunjungan</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</x-layout>
