<x-layout>
<x-navbar></x-navbar>

<div class="max-w-7xl mx-auto px-6 py-12">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-emerald-800">Dashboard Petani</h1>
      <p class="text-sm text-gray-600">Halo, {{ $user->name }} — ringkasan toko dan permintaan kunjungan Anda.</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('marketplace.upload') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-md shadow hover:bg-emerald-500 text-sm">Unggah Produk</a>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow">
      <div class="text-sm text-gray-500">Total Produk</div>
      <div class="text-2xl font-bold text-emerald-700">{{ $stats['total_products'] }}</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <div class="text-sm text-gray-500">Permintaan Menunggu</div>
      <div class="text-2xl font-bold text-amber-600">{{ $stats['pending_requests'] }}</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <div class="text-sm text-gray-500">Disetujui / Ditolak</div>
      <div class="text-2xl font-bold text-emerald-700">{{ $stats['approved_requests'] }} / {{ $stats['rejected_requests'] }}</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
      <div class="text-sm text-gray-500">Total Pendapatan</div>
      <div class="text-2xl font-bold text-emerald-700">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div>
      <h2 class="text-lg font-semibold mb-3">Produk Anda</h2>
      <div class="space-y-4">
        @forelse($products as $p)
          @php
            $thumb = optional($p->images->first())->path ?? $p->image_url ?? 'https://tailwindcss.com/plus-assets/img/ecommerce-images/category-page-04-image-card-01.jpg';
            $thumbUrl = preg_match('/^https?:\/\//', $thumb) ? $thumb : asset(ltrim($thumb, '/'));
          @endphp
          <div class="bg-white p-4 rounded-lg shadow flex items-center gap-4">
            <img src="{{ $thumbUrl }}" alt="{{ $p->name }}" class="w-20 h-20 object-cover rounded" />
            <div class="flex-1">
              <div class="font-semibold">{{ $p->name }}</div>
              <div class="text-sm text-gray-500">Rp {{ number_format($p->price,0,',','.') }} / {{ $p->unit ?? 'kg' }}</div>
              <div class="text-xs text-gray-400">Stok: {{ $p->stock }}</div>
            </div>
            <div>
              <a href="{{ route('marketplace.detail', $p->product_id) }}" class="text-sm text-emerald-600">Lihat</a>
            </div>
          </div>
        @empty
          <div class="bg-white p-4 rounded-lg shadow text-gray-500">Belum ada produk. <a href="{{ route('marketplace.upload') }}" class="text-emerald-600">Unggah sekarang</a></div>
        @endforelse
      </div>
    </div>

    <div>
      <h2 class="text-lg font-semibold mb-3">Permintaan Kunjungan</h2>
      <div class="space-y-3">
        @forelse($requests as $req)
          <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-start justify-between">
              <div>
                <div class="font-medium">{{ $req->user->name }} — <span class="text-sm text-gray-500">{{ $req->user->email }}</span></div>
                <div class="text-sm text-gray-600">Produk: {{ $req->product->name ?? '-' }}</div>
                <div class="text-sm text-gray-600">Tanggal: {{ $req->visit_date }} {{ $req->visit_time }}</div>
                <div class="text-sm text-gray-600">Jumlah: {{ $req->quantity }}</div>
              </div>
              <div class="flex flex-col items-end gap-2">
                @if($req->status === 'pending' || $req->status === null)
                  <form action="{{ route('visit_requests.approve', $req->request_id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-emerald-600 text-white px-3 py-1.5 rounded-md">Setujui</button>
                  </form>
                  <form action="{{ route('visit_requests.reject', $req->request_id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-md">Tolak</button>
                  </form>
                @else
                  <div class="text-sm text-gray-500">Status: @if($req->status==='approved')<span class="text-green-600">Disetujui</span>@elseif($req->status==='rejected')<span class="text-red-600">Ditolak</span>@endif</div>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="bg-white p-4 rounded-lg shadow text-gray-500">Belum ada permintaan kunjungan.</div>
        @endforelse
      </div>
    </div>
  </div>

</div>

</x-layout>
