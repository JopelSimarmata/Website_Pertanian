<x-layout>
<x-navbar></x-navbar>

<div class="max-w-3xl mx-auto px-6 py-12">
  <div class="mb-6">
    <a href="{{ route('dashboard.farmer') }}" class="text-sm text-emerald-600 hover:text-emerald-800 flex items-center gap-1">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      Kembali ke Dashboard
    </a>
  </div>

  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-emerald-800 mb-6">Tambah Produk Baru</h1>

    @if ($errors->any())
      <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('dashboard.farmer.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      {{-- Nama Produk --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          placeholder="Contoh: Beras Organik Premium">
      </div>

      {{-- Kategori --}}
      <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
        <select id="category_id" name="category_id"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
          <option value="">Pilih Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
              {{ $cat->slug }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Deskripsi --}}
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <textarea id="description" name="description" rows="4"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          placeholder="Jelaskan detail produk Anda...">{{ old('description') }}</textarea>
      </div>

      {{-- Harga dan Stok --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
          <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            placeholder="50000">
        </div>
        <div>
          <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
          <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required min="0"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            placeholder="100">
        </div>
        <div>
          <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
          <input type="text" id="unit" name="unit" value="{{ old('unit', 'kg') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            placeholder="kg, liter, ikat, dll">
        </div>
      </div>

      {{-- Lokasi --}}
      <div>
        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
        <input type="text" id="location" name="location" value="{{ old('location') }}"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          placeholder="Contoh: Bandung, Jawa Barat">
      </div>

      {{-- Alamat Detail --}}
      <div>
        <label for="detail_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
        <textarea id="detail_address" name="detail_address" rows="2"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          placeholder="Alamat lengkap untuk kunjungan...">{{ old('detail_address') }}</textarea>
      </div>

      {{-- Kontak --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="farmer_email" class="block text-sm font-medium text-gray-700 mb-1">Email Kontak</label>
          <input type="email" id="farmer_email" name="farmer_email" value="{{ old('farmer_email', auth()->user()->email) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        <div>
          <label for="farmer_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
          <input type="text" id="farmer_phone" name="farmer_phone" value="{{ old('farmer_phone') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            placeholder="08xxxxxxxxxx">
        </div>
      </div>

      {{-- Gambar Utama --}}
      <div>
        <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
        <input type="file" id="image_url" name="image_url" accept="image/*"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 10MB.</p>
      </div>

      {{-- Gambar Tambahan --}}
      <div>
        <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Gambar Tambahan</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        <p class="text-xs text-gray-500 mt-1">Bisa pilih beberapa gambar sekaligus. Maksimal 10 gambar.</p>
      </div>

      {{-- Buttons --}}
      <div class="flex items-center gap-4 pt-4">
        <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 font-medium">
          Simpan Produk
        </button>
        <a href="{{ route('dashboard.farmer') }}" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
          Batal
        </a>
      </div>
    </form>
  </div>
</div>

</x-layout>
