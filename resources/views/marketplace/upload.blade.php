<x-layout>
<x-navbar></x-navbar>

<div class="max-w-3xl mx-auto px-6 py-12">
  <div class="bg-white shadow sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold text-emerald-800">Upload Produk Baru</h2>
    <p class="text-sm text-gray-600 mt-1">Isi data produk pertanian Anda.</p>

    <form action="{{ route('marketplace.upload.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
        <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('description') }}</textarea>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Harga (per kg)</label>
          <input type="number" name="price" value="{{ old('price') }}" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Stok (kg)</label>
          <input type="number" name="stock" value="{{ old('stock', 0) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Lokasi</label>
          <input type="text" name="location" value="{{ old('location') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Unit</label>
          <input type="text" name="unit" value="{{ old('unit', 'kg') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Email penjual (opsional)</label>
          <input type="email" name="farmer_email" value="{{ old('farmer_email') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Telepon penjual (opsional)</label>
          <input type="text" name="farmer_phone" value="{{ old('farmer_phone') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Alamat lengkap (opsional)</label>
        <textarea name="detail_address" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('detail_address') }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Gambar produk (opsional)</label>
        <input type="file" name="image" accept="image/*" class="mt-1 block w-full" />
      </div>

      <div class="flex items-center justify-end gap-3">
        <a href="{{ route('marketplace') }}" class="px-4 py-2 rounded-md bg-gray-200 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded-md bg-emerald-600 text-white">Upload Produk</button>
      </div>
    </form>
  </div>
</div>

</x-layout>
