<x-layout>
<x-navbar></x-navbar>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Back Button --}}
  <div class="mb-6">
    <a href="{{ route('forum.detail', $thread->thread_id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-emerald-300 transition font-medium">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Kembali</span>
    </a>
  </div>

  {{-- Edit Form --}}
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-emerald-500 to-green-500 px-6 py-4">
      <h1 class="text-2xl font-bold text-white flex items-center gap-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Edit Thread
      </h1>
    </div>

    <form action="{{ route('forum.update', $thread->thread_id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
      @csrf
      @method('PUT')

      {{-- Title --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Thread</label>
        <input type="text" name="title" value="{{ old('title', $thread->title) }}" required 
          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition"
          placeholder="Tulis judul yang jelas dan menarik...">
        @error('title')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Category --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori (Opsional)</label>
        <select name="category_id" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition">
          <option value="">Pilih Kategori</option>
          @foreach($categories as $category)
            <option value="{{ $category->category_id }}" {{ old('category_id', $thread->category_id) == $category->category_id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Content --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Thread</label>
        <textarea name="content" rows="8" required
          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 transition resize-none"
          placeholder="Jelaskan pertanyaan atau topik Anda dengan detail...">{{ old('content', $thread->content) }}</textarea>
        @error('content')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Current Images --}}
      @if($thread->image)
        @php
          // Debug: tampilkan raw data
          echo "<!-- DEBUG RAW IMAGE: " . htmlspecialchars($thread->image) . " -->";
          
          $images = is_array($thread->image) ? $thread->image : json_decode($thread->image, true);
          if (!is_array($images)) {
            $images = [$thread->image];
          }
          $images = array_filter($images);
          
          // Debug: tampilkan hasil parse
          echo "<!-- DEBUG PARSED: " . print_r($images, true) . " -->";
        @endphp
        
        @if(!empty($images))
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
              <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              Foto Saat Ini
            </label>
            <div id="existingImagesContainer" class="grid grid-cols-2 gap-3">
              @foreach($images as $index => $img)
                @php
                  $cleanPath = str_replace('\\', '/', $img);
                  $imageUrl = asset('storage/' . $cleanPath);
                @endphp
                <div class="relative aspect-video rounded-xl overflow-hidden border-2 border-gray-200 group bg-white" data-image-path="{{ $cleanPath }}">
                  <div class="absolute inset-0 bg-center bg-contain bg-no-repeat" style="background-image: url('{{ $imageUrl }}');"></div>
                  <img src="{{ $imageUrl }}" 
                       alt="Foto postingan {{ $index + 1 }}" 
                       class="w-full h-full object-contain relative z-10"
                       onload="console.log('✅ Loaded:', this.src); this.previousElementSibling.style.display='none';"
                       onerror="console.error('❌ Failed:', this.src); this.style.display='none';">
                  
                  <!-- Tombol Lihat (pojok kiri atas) -->
                  <button type="button" 
                          onclick="openImageModal('{{ $imageUrl }}')"
                          class="absolute top-2 left-2 bg-white text-gray-800 p-2.5 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-gray-100 shadow-lg transform hover:scale-110 z-30"
                          title="Lihat gambar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                  
                  <!-- Tombol Hapus (pojok kanan atas) -->
                  <button type="button" 
                          onclick="removeExistingImage(this)" 
                          class="absolute top-2 right-2 bg-red-500 text-white p-2.5 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-red-600 shadow-lg transform hover:scale-110 z-30"
                          title="Hapus gambar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                  </button>
                </div>
              @endforeach
            </div>
            <p class="text-xs text-gray-500 mt-2">
              <svg class="w-4 h-4 inline text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Klik foto untuk hapus, atau tambah foto baru di bawah
            </p>
          </div>
        @endif
      @endif

      {{-- Hidden input for deleted images --}}
      <input type="hidden" name="deleted_images" id="deletedImages" value="">
      
      {{-- Hidden input for keeping existing images --}}
      <input type="hidden" name="keep_images" id="keepImages" value="">

      {{-- New Images --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Tambah Foto Baru (Opsional)
        </label>
        <input type="file" name="images[]" multiple accept="image/*" id="imageInput" 
          class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 transition hover:border-emerald-400 cursor-pointer">
        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF, WEBP (Maks 5MB per file). Total foto maksimal 5</p>
        
        {{-- Preview --}}
        <div id="previewContainer" class="grid grid-cols-2 gap-3 mt-4"></div>
      </div>

      {{-- Submit Buttons --}}
      <div class="flex gap-3 pt-4">
        <a href="{{ route('forum.detail', $thread->thread_id) }}" 
          class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-semibold text-center">
          Batal
        </a>
        <button type="submit" 
          class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-500 text-white rounded-xl hover:from-emerald-600 hover:to-green-600 transition font-semibold shadow-lg">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

{{-- Image Modal --}}
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4">
  <div class="relative max-w-7xl max-h-full">
    <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[90vh] object-contain rounded-lg">
    
    {{-- Tombol Close --}}
    <button onclick="closeImageModal()" 
            class="absolute top-4 right-4 bg-white text-gray-800 p-3 rounded-full hover:bg-gray-100 shadow-lg transition transform hover:scale-110">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>
</div>

<script>
// Image Modal Functions
function openImageModal(imageUrl) {
  const modal = document.getElementById('imageModal');
  const modalImage = document.getElementById('modalImage');
  modalImage.src = imageUrl;
  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeImageModal() {
  const modal = document.getElementById('imageModal');
  modal.classList.add('hidden');
  document.body.style.overflow = 'auto';
}

// Close modal when clicking outside image
document.getElementById('imageModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeImageModal();
  }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeImageModal();
  }
});

// Track existing and deleted images
let deletedImages = [];
let existingImages = [];

// Initialize existing images array
document.addEventListener('DOMContentLoaded', function() {
  const existingImgDivs = document.querySelectorAll('#existingImagesContainer [data-image-path]');
  existingImages = Array.from(existingImgDivs).map(div => div.dataset.imagePath);
  updateKeepImages();
});

// Remove existing image
function removeExistingImage(button, imagePath) {
  const imageDiv = button.closest('[data-image-path]');
  
  // Add to deleted array
  if (!deletedImages.includes(imagePath)) {
    deletedImages.push(imagePath);
  }
  
  // Remove from existing array
  existingImages = existingImages.filter(img => img !== imagePath);
  
  // Update hidden inputs
  document.getElementById('deletedImages').value = JSON.stringify(deletedImages);
  updateKeepImages();
  
  // Animate and remove
  imageDiv.style.transform = 'scale(0)';
  imageDiv.style.opacity = '0';
  setTimeout(() => {
    imageDiv.remove();
    
    // Check if no more existing images
    const container = document.getElementById('existingImagesContainer');
    if (container && container.children.length === 0) {
      container.closest('div').style.display = 'none';
    }
  }, 300);
}

function updateKeepImages() {
  document.getElementById('keepImages').value = JSON.stringify(existingImages);
}

// New image preview with remove capability
const imageInput = document.getElementById('imageInput');
const previewContainer = document.getElementById('previewContainer');
let selectedFiles = [];

imageInput.addEventListener('change', function(e) {
  const files = Array.from(e.target.files);
  
  // Add new files to selectedFiles array
  files.forEach(file => {
    // Check total limit (existing + new)
    const totalImages = existingImages.length + selectedFiles.length + 1;
    if (totalImages <= 5) {
      selectedFiles.push(file);
    }
  });
  
  // Check total limit
  const totalImages = existingImages.length + selectedFiles.length;
  if (totalImages > 5) {
    alert(`Total foto maksimal 5. Anda sudah punya ${existingImages.length} foto, hanya bisa tambah ${5 - existingImages.length} lagi.`);
    selectedFiles = selectedFiles.slice(0, 5 - existingImages.length);
  }
  
  updateFileInput();
  renderPreviews();
});

function updateFileInput() {
  const dt = new DataTransfer();
  selectedFiles.forEach(file => dt.items.add(file));
  imageInput.files = dt.files;
}

function renderPreviews() {
  previewContainer.innerHTML = '';
  
  if (selectedFiles.length > 0) {
    selectedFiles.forEach((file, index) => {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        const div = document.createElement('div');
        div.className = 'relative aspect-video rounded-xl overflow-hidden border-2 border-emerald-300 group';
        div.innerHTML = `
          <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-full object-cover">
          <div class="absolute top-2 left-2 bg-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full">
            Baru ${index + 1}
          </div>
          <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-200 flex items-center justify-center">
            <button type="button" onclick="removeNewImage(${index})" 
              class="opacity-0 group-hover:opacity-100 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
              Hapus
            </button>
          </div>
        `;
        previewContainer.appendChild(div);
      };
      
      reader.readAsDataURL(file);
    });
  }
}

function removeNewImage(index) {
  selectedFiles.splice(index, 1);
  updateFileInput();
  renderPreviews();
}
</script>

</x-layout>
