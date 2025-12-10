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
        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar produk (opsional) — pilih banyak</label>
        
        {{-- Mobile-friendly file upload button --}}
        <div class="flex flex-col sm:flex-row gap-3 items-start">
          <label for="product-images" class="cursor-pointer inline-flex items-center px-4 py-3 border-2 border-dashed border-emerald-300 rounded-lg bg-emerald-50 hover:bg-emerald-100 transition text-emerald-700 font-medium w-full sm:w-auto justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Pilih Foto
          </label>
          <input 
            type="file" 
            id="product-images" 
            name="images[]" 
            accept="image/jpeg,image/jpg,image/png,image/webp" 
            multiple 
            capture="environment"
            class="hidden"
            onchange="previewImages(this)" />
          <span id="file-count" class="text-sm text-gray-500 self-center">Belum ada file dipilih</span>
        </div>
        
        {{-- Preview container --}}
        <div id="image-preview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3"></div>
        
        <p class="text-xs text-gray-500 mt-2">
          📱 Bisa ambil foto langsung atau pilih dari galeri<br>
          Maks 10 foto, tiap foto maks 10MB (format: JPG, PNG, WEBP)
        </p>
      </div>

      <script>
        function previewImages(input) {
          const preview = document.getElementById('image-preview');
          const fileCount = document.getElementById('file-count');
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

      <div class="flex items-center justify-end gap-3">
        <a href="{{ route('marketplace') }}" class="px-4 py-2 rounded-md bg-gray-200 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded-md bg-emerald-600 text-white">Upload Produk</button>
      </div>
    </form>
  </div>
</div>

</x-layout>
