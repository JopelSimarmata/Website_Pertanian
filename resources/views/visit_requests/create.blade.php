<x-layout>
<x-navbar></x-navbar>

  <div class="max-w-3xl mx-auto px-6 py-12">
    <div class="bg-white shadow sm:rounded-lg p-6">
      <h2 class="text-xl font-semibold text-emerald-800">Ajukan Tinjau Lokasi</h2>
      <p class="text-sm text-gray-600 mt-1">Lengkapi data kunjungan kepada penjual.</p>

      <form action="{{ route('visit_requests.store') }}" method="POST" class="mt-6 space-y-4">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->product_id ?? old('product_id') }}" />
        <input type="hidden" name="seller_id" value="{{ $product->seller_id ?? $product->farmer_id ?? '' }}" />

        <div>
          <label class="block text-sm font-medium text-gray-700">Produk</label>
          <div class="mt-1 text-sm text-gray-800">{{ $product->name ?? 'Produk tidak ditemukan' }}</div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Jumlah yang ingin dibeli (kg)</label>
          <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal kunjungan</label>
            <input type="date" name="visit_date" value="{{ old('visit_date') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Waktu kunjungan</label>
            <input type="time" name="visit_time" value="{{ old('visit_time') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Catatan untuk petani (opsional)</label>
          <textarea name="notes" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('notes') }}</textarea>
        </div>

        <div class="flex items-center justify-end gap-3">
          <a href="{{ url()->previous() }}" class="px-4 py-2 rounded-md bg-gray-200 text-gray-700">Batal</a>
          <button type="submit" class="px-4 py-2 rounded-md bg-emerald-600 text-white">Kirim Permintaan Kunjungan</button>
        </div>
      </form>
    </div>
  </div>

</x-layout>
