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
        <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
        
        <div class="flex flex-col gap-3">
          <label for="image_url" class="cursor-pointer inline-flex items-center px-4 py-3 border-2 border-dashed border-blue-300 rounded-lg bg-blue-50 hover:bg-blue-100 transition text-blue-700 font-medium w-full sm:w-auto justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Pilih Gambar Utama
          </label>
          <input type="file" id="image_url" name="image_url" accept="image/jpeg,image/jpg,image/png,image/webp" capture="environment" class="hidden" onchange="previewMainImage(this)">
          <span id="main-file-name" class="text-sm text-gray-500">Belum ada file dipilih</span>
        </div>
        
        <div id="main-preview" class="mt-3 hidden">
          <img id="main-preview-img" class="w-full max-w-xs h-48 object-cover rounded-lg border-2 border-gray-200" alt="Preview">
        </div>
        
        <p class="text-xs text-gray-500 mt-2">📱 Format: JPG, PNG, WEBP. Maksimal 10MB.</p>
      </div>

      {{-- Gambar Tambahan --}}
      <div>
        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Gambar Tambahan (Opsional)</label>
        
        <div class="flex flex-col sm:flex-row gap-3 items-start">
          <label for="images" class="cursor-pointer inline-flex items-center px-4 py-3 border-2 border-dashed border-emerald-300 rounded-lg bg-emerald-50 hover:bg-emerald-100 transition text-emerald-700 font-medium w-full sm:w-auto justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Pilih Foto Tambahan
          </label>
          <input type="file" id="images" name="images[]" accept="image/jpeg,image/jpg,image/png,image/webp" multiple capture="environment" class="hidden" onchange="previewMultipleImages(this)">
          <span id="multi-file-count" class="text-sm text-gray-500 self-center">Belum ada file dipilih</span>
        </div>
        
        <div id="multi-preview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3"></div>
        
        <p class="text-xs text-gray-500 mt-2">📱 Bisa ambil foto langsung atau pilih dari galeri. Maksimal 10 foto.</p>
      </div>

      <script>
        // Preview gambar utama
        function previewMainImage(input) {
          const preview = document.getElementById('main-preview');
          const previewImg = document.getElementById('main-preview-img');
          const fileName = document.getElementById('main-file-name');
          
          if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
              alert('⚠️ File terlalu besar! Maksimal 10MB');
              input.value = '';
              return;
            }
            
            // Validate file type
            if (!file.type.match('image/(jpeg|jpg|png|webp)')) {
              alert('⚠️ Format file tidak valid! Gunakan JPG, PNG, atau WEBP');
              input.value = '';
              return;
            }
            
            fileName.textContent = file.name;
            fileName.classList.remove('text-gray-500');
            fileName.classList.add('text-blue-600', 'font-medium');
            
            const reader = new FileReader();
            reader.onload = function(e) {
              previewImg.src = e.target.result;
              preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
          } else {
            preview.classList.add('hidden');
            fileName.textContent = 'Belum ada file dipilih';
            fileName.classList.remove('text-blue-600', 'font-medium');
            fileName.classList.add('text-gray-500');
          }
        }
        
        // Preview multiple images
        function previewMultipleImages(input) {
          const preview = document.getElementById('multi-preview');
          const fileCount = document.getElementById('multi-file-count');
          preview.innerHTML = '';
          
          if (input.files && input.files.length > 0) {
            const fileText = input.files.length === 1 ? '1 foto dipilih' : `${input.files.length} foto dipilih`;
            fileCount.textContent = fileText;
            fileCount.classList.remove('text-gray-500');
            fileCount.classList.add('text-emerald-600', 'font-medium');
            
            // Validate file count
            if (input.files.length > 10) {
              alert('⚠️ Maksimal 10 foto. Silakan pilih ulang.');
              input.value = '';
              fileCount.textContent = 'Belum ada file dipilih';
              fileCount.classList.remove('text-emerald-600', 'font-medium');
              fileCount.classList.add('text-gray-500');
              return;
            }
            
            Array.from(input.files).forEach((file, index) => {
              // Validate file size (10MB)
              if (file.size > 10 * 1024 * 1024) {
                alert(`⚠️ File "${file.name}" terlalu besar (maks 10MB)`);
                return;
              }
              
              // Validate file type
              if (!file.type.match('image/(jpeg|jpg|png|webp)')) {
                alert(`⚠️ File "${file.name}" bukan format gambar yang valid`);
                return;
              }
              
              const reader = new FileReader();
              reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                  <img src="${e.target.result}" class="w-full h-24 sm:h-32 object-cover rounded-lg border-2 border-gray-200" alt="Preview ${index + 1}">
                  <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition rounded-lg flex items-center justify-center">
                    <span class="text-white text-xs bg-emerald-600 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Foto ${index + 1}</span>
                  </div>
                `;
                preview.appendChild(div);
              };
              reader.readAsDataURL(file);
            });
          } else {
            fileCount.textContent = 'Belum ada file dipilih';
            fileCount.classList.remove('text-emerald-600', 'font-medium');
            fileCount.classList.add('text-gray-500');
          }
        }
      </script>

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
