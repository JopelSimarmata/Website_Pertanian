@extends('layouts.app')

@section('title', 'Forum Diskusi Pertanian')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-700 mb-2">Forum Diskusi Pertanian</h2>
    <p class="text-gray-500 mb-6">Berbagi pengalaman dan pengetahuan dengan sesama petani</p>

    {{-- 🔍 Filter dan Tombol Tambah (Layout Anda + Ikon) --}}
    <div class="flex flex-col md:flex-row gap-3 mb-5">

        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" aria-hidden="true">
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <input type="text" class="border rounded-md px-10 py-2 w-full" placeholder="Cari diskusi...">
        </div>

        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" aria-hidden="true">
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013l-2.5 1a2.25 2.25 0 0 1-2.122-2.013v-2.927a2.25 2.25 0 0 0-.659-1.591L2.659 7.409A2.25 2.25 0 0 1 2 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                </svg>
            </div>
            <select class="border rounded-md w-full md:w-auto pl-10 pr-10 py-2 appearance-none">
                <option>Semua Kategori</option>
                <option>Hama & Penyakit</option>
                <option>Teknologi Pertanian</option>
                <option>Harga & Pasar</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" aria-hidden="true">
                 <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06 0L10 10.94l3.71-3.73a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        
        <div class="relative">
            <select class="border rounded-md w-full md:w-auto px-3 py-2 pr-10 appearance-none">
                <option>Semua Status</option>
                <option>Terjawab</option>
                <option>Belum Terjawab</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" aria-hidden="true">
                 <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06 0L10 10.94l3.71-3.73a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        <a href="{{ route('forum.add') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md text-center">+ Buat Diskusi</a>
    </div>

    {{-- 💬 Daftar Thread --}}
    @forelse ($threads as $thread)
        <div class="border border-gray-200 rounded-lg p-4 mb-4 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-green-700">{{ $thread->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">
                        Penulis #{{ $thread->author_id }} · {{ $thread->created_at->diffForHumans() }}
                        @if($thread->is_solved)
                            <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs ml-2">Terjawab</span>
                        @else
                            <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs ml-2">Belum Terjawab</span>
                        @endif
                    </p>
                    <p class="text-gray-700">{{ Str::limit($thread->content, 120) }}</p>
                    @if($thread->tags)
                        <div class="mt-2">
                            @foreach ($thread->tags as $tag)
                                <span class="text-green-700 bg-green-100 px-2 py-0.5 rounded text-sm mr-1">#{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="text-right text-sm text-gray-500">
                    <div>👍 {{ rand(5, 50) }}</div>
                    <div>💬 {{ $thread->replies_count }}</div>
                    <div>👁️ {{ $thread->views_count }}</div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-blue-50 text-blue-700 text-center py-3 rounded">Belum ada diskusi yang dibuat.</div>
    @endforelse
</div>
@endsection