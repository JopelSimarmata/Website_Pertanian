@extends('layouts.app')

@section('title', 'Buat Diskusi Baru')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 p-6">
  <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl border border-gray-100">
    <div class="flex items-center justify-between px-6 py-4 border-b">
      <h2 class="text-lg font-semibold text-gray-800">Buat Diskusi Baru</h2>
      <a href="{{ route('forum.index') }}" class="text-gray-400 hover:text-gray-600" aria-label="Tutup">&times;</a>
    </div>

    <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-6 space-y-4">
      @csrf

      {{-- Judul --}}
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Diskusi</label>
        <input id="title" name="title" value="{{ old('title') }}" type="text" placeholder="Tulis judul yang jelas dan deskriptif"
          class="mt-2 w-full rounded-lg border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" required>
        @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
      </div>

      {{-- Kategori --}}
      <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
        <select id="category_id" name="category_id" class="mt-2 w-full rounded-lg border border-gray-200 px-4 py-2 text-sm bg-white focus:outline-none">
          <option value="">Pilih kategori</option>

          {{-- Pilihan statis sesuai permintaan --}}
          <option value="hama_penyakit" {{ old('category_id') == 'hama_penyakit' ? 'selected' : '' }}>Hama & Penyakit</option>
          <option value="tips_trik" {{ old('category_id') == 'tips_trik' ? 'selected' : '' }}>Tips & Trik</option>
          <option value="teknologi_pertanian" {{ old('category_id') == 'teknologi_pertanian' ? 'selected' : '' }}>Teknologi Pertanian</option>
          <option value="harga_pasar" {{ old('category_id') == 'harga_pasar' ? 'selected' : '' }}>Harga & Pasar</option>
          <option value="panen_pasca_panen" {{ old('category_id') == 'panen_pasca_panen' ? 'selected' : '' }}>Panen & Pasca Panen</option>

          {{-- Jika ada kategori dinamis dari database, tampilkan juga --}}
          @foreach($categories ?? [] as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
        @error('category_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
      </div>

      {{-- Isi Diskusi --}}
      <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Isi Diskusi</label>
        <textarea id="content" name="content" rows="6" placeholder="Jelaskan pertanyaan atau topik yang ingin didiskusikan..."
          class="mt-2 w-full rounded-lg border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" required>{{ old('content') }}</textarea>
        @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
      </div>

      {{-- Lampiran Gambar --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Lampiran Gambar (Opsional)</label>
        <div class="mt-2 flex items-center gap-3">
          <input id="image" name="image" type="file" accept="image/*" onchange="previewImage(event)"
            class="text-sm text-gray-600">
          <button type="button" onclick="clearImage()" class="text-sm text-gray-500 hover:text-gray-700">Hapus</button>
        </div>
        @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

        <div id="image-preview" class="mt-3 hidden">
          <p class="text-xs text-gray-500 mb-2">Pratinjau:</p>
          <img id="preview" class="w-full max-h-60 object-contain rounded-lg border">
        </div>
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end gap-3 pt-2">
        <a href="{{ route('forum.index') }}" class="px-4 py-2 rounded-lg border border-gray-200 text-sm text-gray-700 hover:bg-gray-50">Batal</a>
        <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm">Posting</button>
      </div>
    </form>
  </div>
</div>

<script>
  function previewImage(event) {
    const file = event.target.files && event.target.files[0];
    const container = document.getElementById('image-preview');
    const preview = document.getElementById('preview');
    if (file) {
      preview.src = URL.createObjectURL(file);
      container.classList.remove('hidden');
    } else {
      container.classList.add('hidden');
      preview.src = '';
    }
  }
  function clearImage() {
    const input = document.getElementById('image');
    input.value = '';
    const container = document.getElementById('image-preview');
    const preview = document.getElementById('preview');
    preview.src = '';
    container.classList.add('hidden');
  }
</script>
@endsection
// ...existing code...