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
          $images = is_array($thread->image) ? $thread->image : json_decode($thread->image, true);
          if (!is_array($images)) {
            $images = [$thread->image];
          }
        @endphp
        
        @if(!empty($images))
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Saat Ini</label>
            <div class="grid grid-cols-2 gap-3">
              @foreach($images as $img)
                <div class="relative aspect-video rounded-lg overflow-hidden border-2 border-gray-200">
                  <img src="{{ asset('storage/' . $img) }}" alt="Thread image" class="w-full h-full object-cover">
                </div>
              @endforeach
            </div>
            <p class="text-xs text-gray-500 mt-2">Upload gambar baru di bawah untuk mengganti</p>
          </div>
        @endif
      @endif

      {{-- New Images --}}
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Gambar Baru (Opsional, max 4)</label>
        <input type="file" name="images[]" multiple accept="image/*" id="imageInput" 
          class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 transition">
        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF (Max 5MB per file)</p>
        
        {{-- Preview --}}
        <div id="previewContainer" class="grid grid-cols-2 gap-3 mt-4 hidden"></div>
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

<script>
// Image preview
const imageInput = document.getElementById('imageInput');
const previewContainer = document.getElementById('previewContainer');

imageInput.addEventListener('change', function(e) {
  const files = Array.from(e.target.files);
  
  if (files.length > 4) {
    alert('Maksimal 4 gambar');
    this.value = '';
    return;
  }
  
  previewContainer.innerHTML = '';
  
  if (files.length > 0) {
    previewContainer.classList.remove('hidden');
    
    files.forEach((file, index) => {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        const div = document.createElement('div');
        div.className = 'relative aspect-video rounded-lg overflow-hidden border-2 border-emerald-200';
        div.innerHTML = `
          <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-full object-cover">
          <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs px-2 py-1 rounded-full">
            ${index + 1}
          </div>
        `;
        previewContainer.appendChild(div);
      };
      
      reader.readAsDataURL(file);
    });
  } else {
    previewContainer.classList.add('hidden');
  }
});
</script>

</x-layout>
