<x-layout>
<x-navbar></x-navbar>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  {{-- Back Button --}}
  <div class="mb-6">
    <a href="/visit-requests" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Kembali</span>
    </a>
  </div>

<div class="bg-white shadow rounded-lg border border-gray-200 overflow-hidden">
  
  {{-- Header --}}
  <div class="bg-emerald-600 px-6 py-5 border-b border-emerald-700">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-white">Detail Permintaan Kunjungan</h1>
        <p class="text-sm text-emerald-100 mt-1">Informasi lengkap kunjungan ke lokasi petani</p>
      </div>
      @php
        $status = $vr->status ?? 'pending';
        $statusConfig = [
          'pending' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'label' => 'Menunggu'],
          'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Disetujui'],
          'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'label' => 'Ditolak'],
          'cancelled' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'label' => 'Dibatalkan'],
        ];
        $config = $statusConfig[$status] ?? $statusConfig['pending'];
      @endphp
      <div class="inline-flex items-center px-4 py-2 {{ $config['bg'] }} {{ $config['text'] }} rounded-lg font-semibold">
        <span>{{ $config['label'] }}</span>
      </div>
    </div>
  </div>

  <div class="p-6 space-y-6">

    {{-- Product Card --}}
    <div class="bg-gray-50 rounded-lg border border-gray-200 p-5">
      @php
        $product = $vr->product;
        $img = null;
        if ($product && isset($product->images) && $product->images->count() > 0) {
          $img = $product->images->first()->path ?? null;
        }
        $img = $img ?? ($product->image_url ?? 'https://images.unsplash.com/photo-1560493676-04071c5f467b?w=400&h=300&fit=crop');
        $unit = $product->unit ?? 'kg';
        $price = $product->price ?? null;
        $quantity = $vr->quantity ?? 0;
        $total = ($price !== null) ? ($price * $quantity) : null;
      @endphp

      <div class="flex items-start gap-6">
        <div class="shrink-0">
          <img src="{{ $img }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200" alt="{{ $product->name ?? 'Produk' }}" />
        </div>

        <div class="flex-1 min-w-0">
          <div class="flex items-start justify-between gap-4 mb-4">
            <div>
              <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $product->name ?? 'Produk Tidak Diketahui' }}</h3>
              @if($product->category)
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                  {{ ucfirst(str_replace('-', ' ', $product->category->slug)) }}
                </span>
              @endif
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div class="flex items-center gap-3 text-gray-600">
              <div class="w-10 h-10 bg-blue-50 rounded flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500">Jumlah Pesanan</p>
                <p class="font-bold text-gray-900">{{ number_format($quantity) }} {{ $unit }}</p>
              </div>
            </div>

            <div class="flex items-center gap-3 text-gray-600">
              <div class="w-10 h-10 bg-emerald-50 rounded flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500">Stok Tersedia</p>
                <p class="font-bold text-gray-900">{{ number_format($product->stock ?? 0) }} {{ $unit }}</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-lg p-4 border border-emerald-200">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm text-gray-600">Harga per {{ $unit }}</span>
              <span class="text-lg font-semibold text-emerald-600">{{ $price ? 'Rp '.number_format($price) : '—' }}</span>
            </div>
            <div class="flex items-center justify-between pt-2 border-t border-gray-200">
              <span class="font-semibold text-gray-700">Total Estimasi</span>
              <span class="text-xl font-bold text-emerald-600">{{ $total ? 'Rp '.number_format($total) : '—' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Schedule --}}
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        Jadwal Kunjungan
      </h3>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
          <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-blue-500 rounded flex items-center justify-center shrink-0">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-blue-600">Tanggal Kunjungan</span>
          </div>
          <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($vr->visit_date)->locale('id')->translatedFormat('l, d F Y') }}</p>
        </div>

        <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
          <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-purple-500 rounded flex items-center justify-center shrink-0">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-purple-600">Waktu Kunjungan</span>
          </div>
          <p class="text-xl font-bold text-gray-900">{{ $vr->visit_time ?? '-' }}</p>
        </div>
      </div>
    </div>

    {{-- Party Information --}}
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        Informasi Pihak Terkait
      </h3>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-300">
          <div class="flex items-center gap-3 mb-4">
            @php
              $buyerAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($vr->user->name ?? 'Pembeli') . '&color=6366f1&background=e0e7ff';
            @endphp
            <img src="{{ $buyerAvatar }}" alt="{{ $vr->user->name ?? 'Pembeli' }}" class="w-12 h-12 rounded-full border-2 border-indigo-200">
            <div>
              <p class="text-xs text-gray-500 font-medium">Pembeli</p>
              <p class="font-bold text-gray-900">{{ $vr->user->name ?? 'Pembeli' }}</p>
            </div>
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>{{ $vr->user->email ?? '-' }}</span>
          </div>
        </div>

        <div class="bg-emerald-50 rounded-lg p-4 border border-emerald-300">
          <div class="flex items-center gap-3 mb-4">
            @php
              $farmerAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($vr->seller->name ?? 'Petani') . '&color=059669&background=d1fae5';
            @endphp
            <img src="{{ $farmerAvatar }}" alt="{{ $vr->seller->name ?? 'Petani' }}" class="w-12 h-12 rounded-full border-2 border-emerald-300">
            <div>
              <p class="text-xs text-emerald-600 font-medium">Petani</p>
              <p class="font-bold text-gray-900">{{ $vr->seller->name ?? 'Petani' }}</p>
            </div>
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>{{ $product->location ?? ($vr->seller->email ?? '-') }}</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Location Info --}}
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        Lokasi Kunjungan
      </h3>

      <div class="bg-emerald-50 rounded-lg p-5 border border-emerald-200">
        <div class="space-y-4">
          <div>
            <p class="text-sm font-medium text-emerald-600 mb-2">Alamat Lengkap</p>
            <p class="text-lg font-semibold text-gray-900">{{ $product->detail_address ?? $product->location ?? 'Alamat tidak tersedia' }}</p>
          </div>

          <div class="pt-4 border-t border-emerald-200">
            <p class="text-sm font-medium text-emerald-600 mb-2">Nomor Telepon Petani</p>
            <a href="tel:{{ $product->farmer_phone ?? ($vr->seller->phone ?? '') }}" class="inline-flex items-center gap-2 text-lg font-bold text-emerald-700 hover:text-emerald-800">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              {{ $product->farmer_phone ?? ($vr->seller->phone ?? '-') }}
            </a>
          </div>

          <div class="bg-white rounded-lg p-4 border border-gray-200">
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-emerald-500 rounded flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <p class="font-semibold text-gray-900 mb-1">Petunjuk Kunjungan</p>
                <p class="text-sm text-gray-600">Hubungi petani terlebih dahulu untuk konfirmasi kedatangan dan mendapatkan petunjuk arah yang lebih detail.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Notes --}}
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
        </svg>
        Catatan dari Pembeli
      </h3>
      <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
        <p class="text-gray-700">{{ $vr->notes ?? 'Tidak ada catatan tambahan' }}</p>
      </div>
    </div>

  @php
    $me = auth()->user();
    $orderExists = isset($order) && $order;
    $paymentStatus = null;
    $isPaid = false;
    $paymentDate = null;
    if ($orderExists) {
        $paymentStatus = $order->status ?? ($latestPayment->status ?? null);
        $isPaid = ($paymentStatus === 'paid' || $paymentStatus === 'settlement');
        $paymentDate = $latestPayment?->payment_date ?? $order->updated_at ?? null;
    }
  @endphp

    {{-- Payment Status --}}
    @if($orderExists && $isPaid)
      <div class="bg-emerald-50 rounded-lg p-5 border border-emerald-300">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-emerald-500 rounded flex items-center justify-center shrink-0">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div>
              <p class="font-bold text-emerald-800 text-lg mb-1">Pembayaran Berhasil</p>
              <div class="space-y-1 text-sm text-gray-700">
                <p>Invoice: <a class="font-semibold text-emerald-700 hover:text-emerald-800 underline" href="{{ route('orders.show', ['order' => $order->invoice_number]) }}">{{ $order->invoice_number }}</a></p>
                <p>Jumlah: <span class="font-bold text-emerald-800">Rp {{ number_format($order->gross_amount ?? 0, 0, ',', '.') }}</span></p>
                @if($paymentDate)
                  <p>Tanggal: {{ \Carbon\Carbon::parse($paymentDate)->locale('id')->translatedFormat('l, d F Y H:i') }}</p>
                @endif
              </div>
            </div>
          </div>
          <a href="{{ route('orders.show', ['order' => $order->invoice_number]) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-emerald-600 text-emerald-700 rounded-lg hover:bg-emerald-50 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Lihat Invoice
          </a>
        </div>
      </div>
    @else
      @if($me && ($me->id === $vr->buyer_id) && ($vr->status === 'approved'))
        <div class="bg-amber-50 rounded-lg p-5 border border-amber-300">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 bg-amber-500 rounded flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <p class="font-bold text-amber-800 text-lg mb-1">Permintaan Disetujui</p>
                <p class="text-sm text-amber-700">Silakan lanjutkan ke pembayaran untuk menyelesaikan transaksi</p>
              </div>
            </div>
            <a href="{{ route('payments.create', ['request_id' => $vr->request_id]) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
              </svg>
              Lanjut ke Pembayaran
            </a>
          </div>
        </div>
      @endif
    @endif
  </div>

  {{-- Footer --}}
  <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
    <div class="flex items-center gap-2 text-sm text-gray-500">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span>Diajukan pada {{ \Carbon\Carbon::parse($vr->created_at)->locale('id')->translatedFormat('l, d F Y') }} pukul {{ \Carbon\Carbon::parse($vr->created_at)->format('H:i') }}</span>
    </div>
  </div>

</div>
</div>


</x-layout>
