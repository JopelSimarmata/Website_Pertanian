<x-layout>
<x-navbar></x-navbar>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Header --}}
  <div class="mb-6">
    <a href="{{ route('forum.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-emerald-300 transition font-medium">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Kembali ke Forum</span>
    </a>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    
    {{-- Header Card --}}
    <div class="bg-gradient-to-r from-emerald-600 to-green-600 px-8 py-6 text-white">
      <h1 class="text-2xl font-bold mb-2">Buat Thread Baru</h1>
      <p class="text-emerald-50">Bagikan pertanyaan, pengalaman, atau pengetahuan Anda dengan komunitas</p>
    </div>

    {{-- Form --}}
    <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
      @csrf

      {{-- Error Messages --}}
      @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
          <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
              <h3 class="font-semibold text-red-800 mb-1">Terdapat kesalahan:</h3>
              <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @endif

      <div class="space-y-6">
        
        {{-- Kategori --}}
        <div>
          <label class="block text-sm font-bold text-gray-900 mb-2">
            Kategori <span class="text-red-500">*</span>
          </label>
          <select name="category_id" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition">
            <option value="">Pilih kategori...</option>
            @foreach(\App\Models\ForumCategories::all() as $cat)
              <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          <p class="text-sm text-gray-500 mt-1">Pilih kategori yang sesuai dengan topik diskusi Anda</p>
        </div>

        {{-- Judul --}}
        <div>
          <label class="block text-sm font-bold text-gray-900 mb-2">
            Judul Thread <span class="text-red-500">*</span>
          </label>
          <input 
            type="text" 
            name="title" 
            value="{{ old('title') }}"
            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" 
            placeholder="Contoh: Bagaimana cara mengatasi hama wereng pada padi?"
            required
          >
          <p class="text-sm text-gray-500 mt-1">Tulis judul yang jelas dan deskriptif</p>
        </div>

        {{-- Isi Diskusi --}}
        <div>
          <label class="block text-sm font-bold text-gray-900 mb-2">
            Isi Diskusi <span class="text-red-500">*</span>
          </label>
          <textarea 
            name="content" 
            rows="8" 
            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition resize-none" 
            placeholder="Jelaskan pertanyaan atau topik diskusi Anda secara detail..."
            required
          >{{ old('content') }}</textarea>
          <p class="text-sm text-gray-500 mt-1">Berikan detail yang cukup agar komunitas dapat membantu Anda</p>
        </div>

        {{-- Tags --}}
        <div>
          <label class="block text-sm font-bold text-gray-900 mb-2">
            Tag <span class="text-gray-500 text-xs font-normal">(opsional)</span>
          </label>
          <input 
            type="text" 
            name="tags" 
            value="{{ old('tags') }}"
            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition" 
            placeholder="pisahkan dengan koma: hama, pupuk, padi"
          >
          <p class="text-sm text-gray-500 mt-1">Tambahkan tag untuk memudahkan pencarian (pisahkan dengan koma)</p>
        </div>

        {{-- Image Upload --}}
        <div>
          <label class="block text-sm font-bold text-gray-900 mb-2">
            Lampiran Gambar <span class="text-gray-500 text-xs font-normal">(opsional, maksimal 4 gambar)</span>
          </label>
          <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-500 transition">
            <input 
              type="file" 
              name="images[]" 
              accept="image/*" 
              multiple
              class="hidden" 
              id="image-input"
              onchange="previewImages(event)"
            >
            <label for="image-input" class="cursor-pointer">
              <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-sm text-gray-600 mb-1">
                  <span class="font-semibold text-emerald-600">Klik untuk upload</span> atau drag and drop
                </p>
                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB per gambar (maks. 4 gambar)</p>
              </div>
            </label>
          </div>

          {{-- Images Preview Grid --}}
          <div id="images-preview" class="mt-4 hidden">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3" id="preview-grid">
              <!-- Preview items will be inserted here -->
            </div>
            <div class="mt-2 text-sm text-gray-600">
              <span id="image-count">0</span> / 4 gambar
            </div>
          </div>
        </div>

        {{-- Guidelines --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
          <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
              <h4 class="font-semibold text-blue-900 mb-2">Panduan Membuat Thread:</h4>
              <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                <li>Gunakan judul yang jelas dan spesifik</li>
                <li>Jelaskan masalah atau topik dengan detail</li>
                <li>Sertakan konteks yang relevan (lokasi, jenis tanaman, dll)</li>
                <li>Bersikap sopan dan menghargai pendapat orang lain</li>
                <li>Gunakan bahasa yang mudah dipahami</li>
              </ul>
            </div>
          </div>
        </div>

      </div>

      {{-- Action Buttons --}}
      <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200">
        <button 
          type="submit" 
          class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-8 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-semibold shadow-lg"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          Publikasikan Thread
        </button>
        <a 
          href="{{ route('forum.index') }}" 
          class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-8 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-semibold"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
          Batal
        </a>
      </div>

    </form>
  </div>

</div>

<script>
  let selectedFiles = [];
  const MAX_IMAGES = 4;

  function previewImages(event) {
    const files = Array.from(event.target.files);
    const container = document.getElementById('images-preview');
    const grid = document.getElementById('preview-grid');
    const countDisplay = document.getElementById('image-count');

    // Check if adding new files would exceed the limit
    if (selectedFiles.length + files.length > MAX_IMAGES) {
      alert(`Maksimal ${MAX_IMAGES} gambar. Anda sudah memilih ${selectedFiles.length} gambar.`);
      return;
    }

    // Add new files to selectedFiles array
    files.forEach((file, index) => {
      if (selectedFiles.length < MAX_IMAGES) {
        selectedFiles.push(file);
        
        const reader = new FileReader();
        reader.onload = function(e) {
          const previewItem = document.createElement('div');
          previewItem.className = 'relative group';
          previewItem.innerHTML = `
            <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
            <button 
              type="button" 
              onclick="removeImage(${selectedFiles.length - 1})" 
              class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full hover:bg-red-600 transition flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
            <div class="absolute bottom-2 left-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
              ${selectedFiles.length}
            </div>
          `;
          grid.appendChild(previewItem);
        };
        reader.readAsDataURL(file);
      }
    });

    // Update display
    if (selectedFiles.length > 0) {
      container.classList.remove('hidden');
      countDisplay.textContent = selectedFiles.length;
    }

    // Reset input to allow selecting same files again if needed
    event.target.value = '';
  }

  function removeImage(index) {
    selectedFiles.splice(index, 1);
    updatePreview();
  }

  function updatePreview() {
    const container = document.getElementById('images-preview');
    const grid = document.getElementById('preview-grid');
    const countDisplay = document.getElementById('image-count');
    const input = document.getElementById('image-input');

    grid.innerHTML = '';

    if (selectedFiles.length === 0) {
      container.classList.add('hidden');
      return;
    }

    selectedFiles.forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = function(e) {
        const previewItem = document.createElement('div');
        previewItem.className = 'relative group';
        previewItem.innerHTML = `
          <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
          <button 
            type="button" 
            onclick="removeImage(${index})" 
            class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white rounded-full hover:bg-red-600 transition flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
          <div class="absolute bottom-2 left-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
            ${index + 1}
          </div>
        `;
        grid.appendChild(previewItem);
      };
      reader.readAsDataURL(file);
    });

    countDisplay.textContent = selectedFiles.length;
    container.classList.remove('hidden');

    // Update file input with current selection
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
  }
</script>

</x-layout>
