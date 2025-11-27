<x-layout>
<x-navbar></x-navbar>

<div class="max-w-3xl mx-auto px-6 py-12">
  <div class="bg-white shadow sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold text-emerald-800">Detail Permintaan Kunjungan</h2>

    <div class="mt-4 space-y-2 text-sm text-gray-700">
      <div><strong>Peminta:</strong> {{ $vr->user->name }} ({{ $vr->user->email }})</div>
      <div><strong>Petani / Penjual:</strong> {{ $vr->seller->name ?? '-' }}</div>
      <div><strong>Produk:</strong> {{ $vr->product->name ?? '-' }}</div>
      <div><strong>Tanggal:</strong> {{ $vr->visit_date }} {{ $vr->visit_time }}</div>
      <div><strong>Jumlah:</strong> {{ $vr->quantity }}</div>
      <div><strong>Status:</strong>
        @if($vr->status === 'approved') <span class="text-green-600">Disetujui</span>
        @elseif($vr->status === 'rejected') <span class="text-red-600">Ditolak</span>
        @elseif($vr->status === 'cancelled') <span class="text-gray-600">Dibatalkan</span>
        @else <span class="text-amber-600">Menunggu</span>
        @endif
      </div>
      <div><strong>Catatan:</strong> {{ $vr->notes ?? '-' }}</div>
    </div>

    <div class="mt-6 flex gap-3">
      <a href="{{ route('visit_requests.index') }}" class="px-4 py-2 bg-gray-200 rounded">Kembali</a>

      @if($user && $user->id === $vr->buyer_id && ($vr->status === 'pending' || $vr->status === null))
        <form action="{{ route('visit_requests.cancel', $vr->request_id) }}" method="POST">
          @csrf
          <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Batal</button>
        </form>
      @endif

      @if($user && $user->id === $vr->seller_id && ($vr->status === 'pending' || $vr->status === null))
        <form action="{{ route('visit_requests.approve', $vr->request_id) }}" method="POST">
          @csrf
          <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded">Setujui</button>
        </form>
        <form action="{{ route('visit_requests.reject', $vr->request_id) }}" method="POST">
          @csrf
          <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Tolak</button>
        </form>
      @endif

      @if($user && $user->id === $vr->buyer_id && $vr->status === 'approved')
        @php $hasPayment = \App\Models\Payments::where('request_id', $vr->request_id)->whereIn('status',['completed','paid'])->exists(); @endphp
        @if(!$hasPayment)
          <a href="{{ route('payments.create', ['request_id' => $vr->request_id]) }}" class="px-4 py-2 bg-emerald-600 text-white rounded">Lakukan Pembayaran</a>
        @else
          <span class="px-4 py-2 text-sm text-gray-500">Pembayaran tercatat</span>
        @endif
      @endif
    </div>
  </div>
</div>

</x-layout>
