<x-layout>
<x-navbar></x-navbar>

<style>
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  @keyframes scaleIn {
    from { 
      opacity: 0;
      transform: scale(0.9) translateY(-20px);
    }
    to { 
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }
</style>

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
            Lampiran Gambar <span class="text-gray-500 text-xs font-normal">(opsional, max 5 foto)</span>
          </label>
          <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-500 transition">
            <input 
              type="file" 
              name="images[]" 
              accept="image/jpeg,image/png,image/jpg,image/gif" 
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
                <p class="text-xs text-gray-500">PNG, JPG, GIF (max 5 foto)</p>
              </div>
            </label>
          </div>

          {{-- Image Preview Grid --}}
          <div id="image-preview" class="mt-4 hidden">
            {{-- Preview Header --}}
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="text-sm font-semibold text-gray-700">
                  <span id="selected-count">0</span> foto terpilih
                </span>
              </div>
              <button 
                type="button" 
                onclick="clearAllImages()" 
                class="text-xs font-semibold text-red-600 hover:text-red-700 hover:underline transition flex items-center gap-1"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus Semua
              </button>
            </div>
            
            {{-- Preview Grid --}}
            <div id="preview-grid" class="grid grid-cols-2 sm:grid-cols-3 gap-3"></div>
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

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between mt-4">
          <a 
            href="{{ route('forum.index') }}" 
            class="inline-flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-emerald-600 transition-colors duration-200 font-medium"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Forum
          </a>
          
          <button 
            type="submit" 
            class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-emerald-600 to-green-600 text-white rounded-xl hover:from-emerald-700 hover:to-green-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Publikasikan Thread
          </button>
        </div>

      </div>

    </form>
  </div>

</div>

<script>
  let selectedFiles = [];

  async function previewImages(event) {
    const newFiles = Array.from(event.target.files);
    const container = document.getElementById('image-preview');
    const grid = document.getElementById('preview-grid');
    
    // Add new files to existing array
    const totalFiles = [...selectedFiles, ...newFiles];
    
    // Check total limit (5 images max)
    if (totalFiles.length > 5) {
      showModal(
        'Batas Maksimal Tercapai',
        `Anda sudah memilih <strong>${selectedFiles.length} foto</strong>.<br>Hanya bisa menambahkan <strong>${5 - selectedFiles.length} foto lagi</strong> (maksimal 5 foto total).`,
        'warning'
      );
      event.target.value = '';
      return;
    }
    
    // Process and compress files if needed
    showToast('Memproses gambar...', 'info');
    const processedFiles = [];
    
    for (let file of newFiles) {
      // Check if file needs compression (> 5MB)
      if (file.size > 5 * 1024 * 1024) {
        showToast(`Mengompres ${file.name}...`, 'info');
        try {
          const compressedFile = await compressImage(file);
          processedFiles.push(compressedFile);
          showToast(`${file.name} berhasil dikompres!`, 'success');
        } catch (error) {
          showModal(
            'Gagal Mengompres',
            `File "<strong>${file.name}</strong>" gagal dikompres. Silakan coba file lain.`,
            'error'
          );
          event.target.value = '';
          return;
        }
      } else {
        processedFiles.push(file);
      }
    }
    
    // Add processed files to selected files array
    selectedFiles = [...selectedFiles, ...processedFiles];
    
    // Update the file input with all selected files
    updateFileInput();
    
    // Render all previews
    renderPreviews();
  }

  // Compress image function
  async function compressImage(file, maxSizeMB = 5, quality = 0.8) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        const img = new Image();
        
        img.onload = function() {
          const canvas = document.createElement('canvas');
          let width = img.width;
          let height = img.height;
          
          // Calculate new dimensions (max 1920px width)
          const maxWidth = 1920;
          if (width > maxWidth) {
            height = (height * maxWidth) / width;
            width = maxWidth;
          }
          
          canvas.width = width;
          canvas.height = height;
          
          const ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
          
          // Try different quality levels until file size is acceptable
          let currentQuality = quality;
          
          const tryCompress = () => {
            canvas.toBlob(
              (blob) => {
                if (!blob) {
                  reject(new Error('Gagal mengompres gambar'));
                  return;
                }
                
                // Check if size is acceptable or quality is too low
                if (blob.size <= maxSizeMB * 1024 * 1024 || currentQuality <= 0.3) {
                  // Create new file with compressed blob
                  const compressedFile = new File([blob], file.name, {
                    type: file.type,
                    lastModified: Date.now()
                  });
                  resolve(compressedFile);
                } else {
                  // Reduce quality and try again
                  currentQuality -= 0.1;
                  tryCompress();
                }
              },
              file.type,
              currentQuality
            );
          };
          
          tryCompress();
        };
        
        img.onerror = () => reject(new Error('Gagal memuat gambar'));
        img.src = e.target.result;
      };
      
      reader.onerror = () => reject(new Error('Gagal membaca file'));
      reader.readAsDataURL(file);
    });
  }

  function updateFileInput() {
    const input = document.getElementById('image-input');
    
    try {
      const dt = new DataTransfer();
      
      selectedFiles.forEach(file => {
        dt.items.add(file);
      });
      
      input.files = dt.files;
      
      // Debug log
      console.log('Files in input after update:', input.files.length);
    } catch (e) {
      console.error('Error updating file input:', e);
    }
  }

  function renderPreviews() {
    const container = document.getElementById('image-preview');
    const grid = document.getElementById('preview-grid');
    const countElement = document.getElementById('selected-count');
    
    // Clear grid
    grid.innerHTML = '';
    
    if (selectedFiles.length === 0) {
      container.classList.add('hidden');
      return;
    }
    
    container.classList.remove('hidden');
    
    // Update counter
    if (countElement) {
      countElement.textContent = selectedFiles.length;
    }
    
    selectedFiles.forEach((file, index) => {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        const div = document.createElement('div');
        div.className = 'relative aspect-video rounded-lg overflow-hidden border-2 border-gray-200 hover:border-emerald-400 transition';
        div.innerHTML = `
          <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-full object-cover">
          
          <!-- Remove Button -->
          <button 
            type="button" 
            onclick="removeImage(${index})" 
            class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-110 group"
            title="Hapus gambar"
          >
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
          
          <!-- Image Counter -->
          <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
            ${index + 1}/${selectedFiles.length}
          </div>
          
          <!-- File Size Badge -->
          <div class="absolute top-2 left-2 bg-emerald-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow">
            ${(file.size / 1024 / 1024).toFixed(1)} MB
          </div>
          
          <!-- File Name -->
          <div class="absolute bottom-2 left-2 bg-black/70 text-white text-xs px-2.5 py-1 rounded-full max-w-[60%] truncate" title="${file.name}">
            ${file.name}
          </div>
        `;
        grid.appendChild(div);
      };
      
      reader.readAsDataURL(file);
    });
  }

  function removeImage(index) {
    // Remove file from array
    selectedFiles.splice(index, 1);
    
    // Update file input
    updateFileInput();
    
    // Re-render previews
    renderPreviews();
    
    // Show notification
    showToast('Gambar berhasil dihapus', 'success');
  }

  function clearAllImages() {
    selectedFiles = [];
    const input = document.getElementById('image-input');
    input.value = '';
    renderPreviews();
    showToast('Semua gambar berhasil dihapus', 'info');
  }

  function showToast(message, type = 'success') {
    const colors = {
      success: 'bg-emerald-500',
      error: 'bg-red-500',
      info: 'bg-blue-500'
    };
    
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 300);
    }, 2000);
  }

  function showModal(title, message, type = 'warning') {
    const icons = {
      warning: `
        <svg class="w-16 h-16 text-amber-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
      `,
      error: `
        <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      `,
      info: `
        <svg class="w-16 h-16 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      `
    };

    // Create modal overlay
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] flex items-center justify-center p-4 animate-fadeIn';
    overlay.style.animation = 'fadeIn 0.2s ease-out';
    
    // Create modal content
    overlay.innerHTML = `
      <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all animate-scaleIn" style="animation: scaleIn 0.3s ease-out">
        <div class="p-6 text-center">
          ${icons[type] || icons.warning}
          <h3 class="text-2xl font-bold text-gray-900 mb-3">${title}</h3>
          <p class="text-gray-600 mb-6 leading-relaxed">${message}</p>
          <button 
            onclick="this.closest('.fixed').remove()" 
            class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5"
          >
            OK, Mengerti
          </button>
        </div>
      </div>
    `;
    
    document.body.appendChild(overlay);
    
    // Close on overlay click
    overlay.addEventListener('click', function(e) {
      if (e.target === overlay) {
        overlay.remove();
      }
    });
    
    // Close on Escape key
    const escHandler = function(e) {
      if (e.key === 'Escape') {
        overlay.remove();
        document.removeEventListener('keydown', escHandler);
      }
    };
    document.addEventListener('keydown', escHandler);
  }

  // Debug form submission
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const fileInput = document.getElementById('image-input');
    
    form.addEventListener('submit', function(e) {
      console.log('Form submitting...');
      console.log('File input files count:', fileInput.files.length);
      console.log('Selected files array count:', selectedFiles.length);
      
      // Log each file
      for (let i = 0; i < fileInput.files.length; i++) {
        console.log(`File ${i}:`, fileInput.files[i].name, fileInput.files[i].size);
      }
      
      // If no files in input but we have selectedFiles, try to update one more time
      if (fileInput.files.length === 0 && selectedFiles.length > 0) {
        console.log('Attempting to restore files to input...');
        updateFileInput();
        console.log('After restore, file count:', fileInput.files.length);
      }
    });
  });
</script>

</x-layout>
