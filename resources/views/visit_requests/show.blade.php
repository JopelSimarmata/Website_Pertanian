<x-layout>
<x-navbar></x-navbar>

<div class="max-w-3xl mx-auto px-6 py-12">
  <div class="mb-4">
    <a href="/visit-requests" aria-label="Kembali" class="inline-flex items-center gap-2 px-3 py-2 bg-white border border-emerald-100 text-emerald-700 rounded-md shadow-sm hover:bg-emerald-50 hover:text-emerald-800 transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
      <span class="text-sm font-medium">Kembali</span>
    </a>
  </div>


<div class="max-w-4xl mx-auto bg-white shadow rounded-xl p-6">
  
  <!-- Header -->
  <div class="flex justify-between items-center mb-4">
    <div>
      <h2 class="text-lg font-semibold">Detail Permintaan Kunjungan</h2>
    </div>
    @php
      $status = $vr->status ?? 'pending';
      $statusClasses = [
        'pending' => 'bg-yellow-100 text-yellow-700',
        'approved' => 'bg-green-100 text-green-700',
        'rejected' => 'bg-red-100 text-red-700',
        'cancelled' => 'bg-gray-100 text-gray-700',
      ];
    @endphp
    <span class="{{ $statusClasses[$status] ?? 'bg-yellow-100 text-yellow-700' }} text-sm px-3 py-1 rounded-lg">{{ ucfirst($status) }}</span>
  </div>

  <!-- Produk -->
  <div class="flex gap-4 p-4 rounded-lg bg-gray-50">
    @php
      $product = $vr->product;
      $img = null;
      if ($product && isset($product->images) && $product->images->count() > 0) {
        $img = $product->images->first()->path ?? null;
      }
      $img = $img ?? ($product->image_url ?? 'https://via.placeholder.com/100');
      $unit = $product->unit ?? 'kg';
      $price = $product->price ?? null;
      $quantity = $vr->quantity ?? 0;
      $total = ($price !== null) ? ($price * $quantity) : null;
    @endphp

    <img src="{{ $img }}" class="w-24 h-24 rounded-lg object-cover" />

    <div class="flex-1">
      <h3 class="font-semibold text-lg">{{ $product->name ?? 'Produk Tidak Diketahui' }}</h3>
      <p class="text-sm text-gray-600">Jumlah: {{ number_format($quantity) }} {{ $unit }}</p>
      <p class="text-sm text-gray-600">Stok tersedia: {{ number_format($product->stock ?? 0) }} {{ $unit }}</p>

      <div class="mt-3 p-3 bg-green-50 rounded-lg">
        <div class="flex justify-between items-center text-sm">
          <span>Harga Petani</span>
          <span class="font-semibold">{{ $price ? 'Rp '.number_format($price).' / '.$unit : '—' }}</span>
        </div>

        <div class="flex justify-between items-center text-sm mt-1">
          <span>Total</span>
          <span class="font-semibold">{{ $total ? 'Rp '.number_format($total) : '—' }}</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Jadwal -->
  <div class="mt-6">
    <h3 class="font-semibold mb-3">Jadwal Kunjungan</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="p-4 rounded-lg bg-gray-50">
        <p class="text-gray-500 text-sm">Tanggal</p>
        <p class="font-semibold">{{ \Carbon\Carbon::parse($vr->visit_date)->locale('id')->translatedFormat('l, d F Y') }}</p>
      </div>

      <div class="p-4 rounded-lg bg-gray-50">
        <p class="text-gray-500 text-sm">Waktu</p>
        <p class="font-semibold">{{ $vr->visit_time ?? '-' }}</p>
      </div>
    </div>
  </div>

  <!-- Informasi Pihak -->
  <div class="mt-6">
    <h3 class="font-semibold mb-3">Informasi Pihak Terkait</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <div class="p-4 rounded-lg bg-gray-50">
        <p class="text-gray-500 text-sm">Pembeli</p>
        <p class="font-semibold">{{ $vr->user->name ?? 'Pembeli' }}</p>
        <p class="text-sm text-gray-600">{{ $vr->user->email ?? '' }}</p>
      </div>

      <div class="p-4 rounded-lg bg-gray-50">
        <p class="text-gray-500 text-sm">Petani</p>
        <p class="font-semibold">{{ $vr->seller->name ?? 'Petani' }}</p>
        <p class="text-sm text-gray-600">{{ $product->location ?? ($vr->seller->email ?? '') }}</p>
      </div>

    </div>
  </div>

  <!-- Lokasi Tinjau -->
  <div class="mt-6">
    <h3 class="font-semibold mb-3">Lokasi Tinjau (Alamat Petani)</h3>

    <div class="p-4 rounded-lg bg-green-50">
      <p class="text-gray-500 text-sm">Alamat Lengkap:</p>
      <p class="font-semibold">{{ $product->detail_address ?? $product->location ?? 'Alamat tidak tersedia' }}</p>

      <div class="mt-4">
        <p class="text-gray-500 text-sm">Nomor Telepon Petani:</p>
        <p class="font-semibold text-green-700">{{ $product->farmer_phone ?? ($vr->seller->phone ?? '-') }}</p>
      </div>

      <div class="mt-4 p-3 bg-white rounded-lg text-sm">
        <span class="font-semibold text-green-700">Petunjuk:</span>
        Hubungi petani terlebih dahulu untuk konfirmasi kedatangan dan mendapatkan petunjuk arah.
      </div>
    </div>
  </div>

  <!-- Catatan -->
  <div class="mt-6">
    <h3 class="font-semibold mb-2">Catatan dari Pembeli</h3>
    <div class="p-4 rounded-lg bg-gray-50 text-sm">
      {{ $vr->notes ?? '-' }}
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

  @if($orderExists && $isPaid)
    <div class="mt-6 p-4 rounded-lg bg-green-50 border border-green-100">
      <div class="flex items-center justify-between gap-4">
        <div>
          <div class="text-sm text-green-700 font-semibold">Pembayaran Berhasil</div>
          <div class="text-sm text-gray-700">Invoice: <a class="text-emerald-600 underline" href="{{ route('orders.show', ['order' => $order->invoice_number]) }}">{{ $order->invoice_number }}</a></div>
          <div class="text-sm text-gray-600">Jumlah: Rp {{ number_format($order->gross_amount ?? 0, 0, ',', '.') }}</div>
          @if($paymentDate)
            <div class="text-sm text-gray-600">Tanggal Pembayaran: {{ \Carbon\Carbon::parse($paymentDate)->locale('id')->translatedFormat('l, d F Y H:i') }}</div>
          @endif
        </div>
        <div>
          <a href="{{ route('orders.show', ['order' => $order->invoice_number]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-emerald-100 text-emerald-700 rounded-md shadow-sm hover:bg-emerald-50">Lihat Invoice</a>
        </div>
      </div>
    </div>
  @else
    @if($me && ($me->id === $vr->buyer_id) && ($vr->status === 'approved'))
      <div class="mt-6">
        <a href="{{ route('payments.create', ['request_id' => $vr->request_id]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-md shadow hover:bg-emerald-500">
          <!-- credit card icon -->
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M3 11h18M7 16h.01" />
          </svg>
          <span class="text-sm font-medium">Lanjutkan ke Pembayaran</span>
        </a>
      </div>
    @endif
  @endif

  <!-- Footer -->
  <p class="mt-6 text-sm text-gray-500">Diajukan: {{ \Carbon\Carbon::parse($vr->created_at)->locale('id')->translatedFormat('l, d F Y') }} pukul {{ \Carbon\Carbon::parse($vr->created_at)->format('H.i') }}</p>

</div>


</x-layout>
