<x-layout>
  <x-navbar></x-navbar>

  <div class="max-w-3xl mx-auto px-6 py-12">
    <div class="bg-white p-8 rounded-lg shadow">
      <h1 class="text-2xl font-semibold text-green-700">Pembayaran Selesai</h1>
      <p class="mt-4 text-gray-600">Terima kasih. Pembayaran untuk pesanan <span class="font-semibold">{{ $order->invoice_number }}</span> telah diproses.</p>

      <div class="mt-6">
        @if($status === 'paid')
          <div class="p-4 bg-green-50 rounded">
            <p class="text-green-700">Status: <strong>Berhasil ({{ ucfirst($status) }})</strong></p>
          </div>
        @else
          <div class="p-4 bg-yellow-50 rounded">
            <p class="text-yellow-700">Status: <strong>{{ ucfirst($status) }}</strong></p>
            <p class="text-sm text-gray-600 mt-2">Jika status belum berubah, tunggu notifikasi pembayaran atau hubungi admin.</p>
          </div>
        @endif
      </div>

      <div class="mt-6 flex gap-3">
        <a href="{{ route('orders.show', ['order' => $order->invoice_number]) }}" class="px-4 py-2 bg-emerald-600 text-white rounded">Lihat Pesanan</a>
        <a href="{{ route('marketplace') }}" class="px-4 py-2 border rounded">Kembali ke Marketplace</a>
      </div>

      <p class="mt-6 text-sm text-gray-500">Jika Anda membutuhkan bantuan, hubungi dukungan kami.</p>
    </div>
  </div>
</x-layout>