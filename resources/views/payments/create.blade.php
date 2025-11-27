<x-layout>
<x-navbar></x-navbar>

<div class="max-w-3xl mx-auto px-6 py-12">
  <div class="bg-white shadow sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold text-emerald-800">Pembayaran untuk Permintaan Kunjungan</h2>

    <div class="mt-4 text-sm text-gray-700">
      <p>Produk: <strong>{{ $vr->product->name ?? '-' }}</strong></p>
      <p>Jumlah: <strong>{{ $vr->quantity }}</strong></p>
      <p>Tanggal kunjungan: <strong>{{ $vr->visit_date }} {{ $vr->visit_time }}</strong></p>
      <p class="mt-2">Total yang harus dibayar: <strong>Rp {{ number_format($amount,0,',','.') }}</strong></p>
    </div>

    <form action="{{ route('payments.store') }}" method="POST" class="mt-6 space-y-4">
      @csrf
      <input type="hidden" name="request_id" value="{{ $vr->request_id }}" />
      <input type="hidden" name="amount" value="{{ $amount }}" />

      <div>
        <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
        <select name="payment_method" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
          <option value="bank_transfer">Transfer Bank</option>
          <option value="cash">Tunai saat kunjungan</option>
        </select>
      </div>

      <div class="flex items-center justify-end gap-3">
        <a href="{{ route('visit_requests.index') }}" class="px-4 py-2 rounded-md bg-gray-200 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded-md bg-emerald-600 text-white">Bayar Sekarang</button>
      </div>
    </form>
  </div>
</div>

</x-layout>
