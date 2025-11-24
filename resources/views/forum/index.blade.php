<x-layout>
    <x-navbar />

    <!-- HEADER -->
    <div class="bg-emerald-50 border-b border-emerald-100">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <h1 class="text-2xl font-bold text-emerald-800">Forum Diskusi Pertanian</h1>
            <p class="text-sm text-emerald-700 mt-2">
                Tempat diskusi dan berbagi pengalaman antar petani di seluruh Indonesia.
            </p>

            <!-- PENCARIAN + TOMBOL -->
            <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
                <form action="{{ route('forum.index') }}" method="GET"
                      class="flex-1 flex bg-white rounded-full shadow-sm border border-emerald-100 px-4 py-2 items-center">
                    <svg class="w-5 h-5 text-emerald-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                    <input type="text" name="q" placeholder="Cari diskusi..." value="{{ request('q') }}"
                           class="w-full border-0 focus:ring-0 focus:outline-none text-sm">
                    <button type="submit"
                            class="ml-3 bg-emerald-600 text-white px-4 py-2 rounded-full text-sm hover:bg-emerald-700 transition">
                        Cari
                    </button>
                </form>

                <a href="{{ route('forum.add') }}"
                   class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-full text-sm shadow">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Diskusi
                </a>
            </div>

            <!-- FILTER KATEGORI & STATUS -->
            <div class="mt-4 flex flex-wrap gap-4">
                <form method="GET" action="{{ route('forum.index') }}" id="filterForm" class="flex gap-3">
                    <select name="category" onchange="document.getElementById('filterForm').submit()"
                            class="border border-emerald-200 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Kategori</option>
                        <option value="Hama & Penyakit" {{ request('category') == 'Hama & Penyakit' ? 'selected' : '' }}>
                            Hama & Penyakit
                        </option>
                        <option value="Pupuk & Nutrisi" {{ request('category') == 'Pupuk & Nutrisi' ? 'selected' : '' }}>
                            Pupuk & Nutrisi
                        </option>
                        <option value="Teknologi Pertanian" {{ request('category') == 'Teknologi Pertanian' ? 'selected' : '' }}>
                            Teknologi Pertanian
                        </option>
                        <option value="Tips & Trik" {{ request('category') == 'Tips & Trik' ? 'selected' : '' }}>
                            Tips & Trik
                        </option>
                    </select>

                    <select name="status" onchange="document.getElementById('filterForm').submit()"
                            class="border border-emerald-200 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Status</option>
                        <option value="Terjawab" {{ request('status') == 'Terjawab' ? 'selected' : '' }}>
                            Terjawab
                        </option>
                        <option value="Belum Terjawab" {{ request('status') == 'Belum Terjawab' ? 'selected' : '' }}>
                            Belum Terjawab
                        </option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- ISI FORUM -->
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">
        @if($threads->isEmpty())
            <div class="text-center border border-dashed border-gray-300 p-10 rounded-lg text-gray-500">
                Belum ada diskusi. Jadilah yang pertama membuat thread baru!
            </div>
        @else
            @foreach($threads as $thread)
                <div class="bg-white shadow rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <a href="{{ route('forum.detail', $thread->id) }}"
                               class="text-lg font-semibold text-emerald-800 hover:underline">
                                {{ $thread->title }}
                            </a>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ Str::limit(strip_tags($thread->content), 200) }}
                            </p>

                            <div class="mt-3 flex items-center gap-3 text-xs text-gray-400">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($thread->author->name ?? 'User') }}&background=10B981&color=fff"
                                         class="w-6 h-6 rounded-full border" />
                                    <span>Oleh {{ $thread->author->name ?? 'Anonim' }}</span>
                                </div>
                                <span>•</span>
                                <span>{{ $thread->created_at->diffForHumans() }}</span>
                                @if(isset($thread->category))
                                    <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-xs">{{ $thread->category }}</span>
                                @endif
                                @if(isset($thread->status))
                                    <span class="{{ $thread->status == 'Terjawab' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} px-2 py-0.5 rounded-full text-xs">{{ $thread->status }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Statistik -->
                        <div class="ml-6 flex flex-col text-center text-sm text-gray-500">
                            <div>
                                <div class="font-semibold text-gray-700">{{ $thread->replies_count ?? 0 }}</div>
                                <div class="text-xs text-gray-400">Balasan</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-semibold text-gray-700">{{ $thread->views_count ?? 0 }}</div>
                                <div class="text-xs text-gray-400">Dilihat</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- PAGINATION -->
            <div class="pt-6">
                {{ $threads->withQueryString()->links() }}
            </div>
        @endif
    </div>

</x-layout>
