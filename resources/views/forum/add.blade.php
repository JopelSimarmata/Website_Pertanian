@extends('layouts.app')

@section('title', 'Tambah Diskusi Baru')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-black-700 mb-4">Buat Diskusi Baru</h2>

    <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        {{-- Judul --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Judul</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" placeholder="Masukkan judul diskusi" required>
        </div>

        {{-- Isi Diskusi --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Isi Diskusi</label>
            <textarea name="content" rows="5" class="w-full border rounded px-3 py-2" placeholder="Tulis isi diskusi di sini..." required></textarea>
        </div>

        {{-- Tag --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tag (opsional)</label>
            <input type="text" name="tags" class="w-full border rounded px-3 py-2" placeholder="Contoh: hama, pupuk, panen">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Lampiran Gambar (opsional)</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2" onchange="previewImage(event)">
            

            <div id="image-preview" class="mt-3 hidden">
                <p class="text-gray-600 text-sm mb-2">Pratinjau:</p>
                <img id="preview" class="max-h-60 rounded-lg border shadow-sm">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-3">
            <a href="{{ route('forum.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md">Batal</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md">Simpan</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const container = document.getElementById('image-preview');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection
