<x-layout>
<x-navbar></x-navbar>

{{-- Hero Section --}}
<div class="bg-green-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    <div class="text-center">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Forum Diskusi</h1>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">Punya pertanyaan tentang pertanian? Tanya di sini, kami siap membantu!</p>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('forum.index') }}" class="mt-8 max-w-2xl mx-auto">
      <div class="relative bg-gray-50 rounded-xl border-2 border-gray-200 focus-within:border-emerald-500 transition">
        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
        </svg>
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Contoh: Cara mengatasi hama wereng, pupuk terbaik untuk padi..." 
          class="w-full pl-12 pr-24 py-4 border-0 focus:ring-0 text-gray-900 placeholder-gray-500 bg-transparent" />
        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
          Cari
        </button>
      </div>
    </form>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Filters --}}
  <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center gap-2 mb-4">
      <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
      </svg>
      <h2 class="text-lg font-semibold text-gray-900">Kategori Diskusi</h2>
    </div>
    
    <form method="GET" action="{{ route('forum.index') }}">
      {{-- Hidden search field to preserve search query --}}
      @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
      @endif

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Categories --}}
        <div>
          <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
            Pilih Kategori
          </label>
          <select id="category" name="category" onchange="this.form.submit()" class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->category_id }}" {{ request('category') == $cat->category_id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Status Filter --}}
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
            Status Diskusi
          </label>
          <select id="status" name="status" onchange="this.form.submit()" class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            <option value="">Semua Status</option>
            <option value="solved" {{ request('status') == 'solved' ? 'selected' : '' }}>Sudah Terjawab</option>
            <option value="unsolved" {{ request('status') == 'unsolved' ? 'selected' : '' }}>Belum Terjawab</option>
          </select>
        </div>
      </div>
    </form>
  </div>

  {{-- Main Content with Sidebar --}}
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- Main Content (Left) --}}
    <div class="lg:col-span-2">

  {{-- Search Result Info --}}
  @if(request('search'))
    <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 flex items-center gap-3">
      <svg class="w-6 h-6 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      <div>
        <p class="text-sm text-blue-900">
          Hasil pencarian untuk: <span class="font-bold">"{{ request('search') }}"</span>
        </p>
        <p class="text-xs text-blue-700 mt-0.5">Ditemukan {{ $threads->total() }} diskusi</p>
      </div>
    </div>
  @endif

  {{-- Threads List --}}
  @if($threads->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
      <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <span class="text-5xl">🤔</span>
      </div>
      <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Diskusi</h3>
      <p class="text-gray-600 mb-8 max-w-md mx-auto">
        @if(request('search'))
          Tidak ditemukan diskusi dengan kata kunci tersebut. Coba kata kunci lain atau buat diskusi baru!
        @else
          Jadilah yang pertama memulai diskusi di kategori ini!
        @endif
      </p>
      <a href="{{ route('forum.add') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-semibold text-lg shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Mulai Diskusi Baru
      </a>
    </div>
  @else
    <div class="space-y-4">
      @foreach($threads as $thread)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-gray-300 transition-colors overflow-hidden relative cursor-pointer" onclick="window.location='{{ route('forum.detail', $thread->thread_id) }}'">
          
          {{-- Status Badge - Top Right --}}
          <div class="absolute top-4 right-4 z-10" onclick="event.stopPropagation()">
            @if($thread->is_solved)
              <span class="inline-flex items-center px-3 py-1.5 bg-emerald-500 text-white rounded-full text-xs font-bold">
                Sudah Terjawab
              </span>
            @else
              <span class="inline-flex items-center px-3 py-1.5 bg-rose-500 text-white rounded-full text-xs font-bold">
                Belum Terjawab
              </span>
            @endif
          </div>

          <div class="p-6">
            <div class="flex gap-4">
              
              {{-- Avatar --}}
              <div class="shrink-0">
                @php
                  $authorName = $thread->author->name ?? 'User';
                  $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&color=059669&background=d1fae5&size=56';
                @endphp
                <img src="{{ $avatar }}" alt="{{ $authorName }}" class="w-14 h-14 rounded-full border-2 border-emerald-100 shadow-sm">
              </div>

              {{-- Content --}}
              <div class="flex-1 min-w-0">
                
                {{-- Other Badges (Pinned, Category) --}}
                @if($thread->is_pinned || $thread->category)
                  <div class="flex flex-wrap items-center gap-2 mb-2">
                    @if($thread->is_pinned)
                      <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-bold">
                        📌 Penting
                      </span>
                    @endif
                    @if($thread->category)
                      <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold">
                        {{ $thread->category->icon }} {{ $thread->category->name }}
                      </span>
                    @endif
                  </div>
                @endif
                
                {{-- Title --}}
                <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-emerald-600 transition line-clamp-2">
                  {{ $thread->title }}
                </h3>
                
                {{-- Excerpt --}}
                <p class="text-gray-600 mb-3 line-clamp-2">{{ Str::limit(strip_tags($thread->content), 180) }}</p>

                {{-- Image Preview Grid (Facebook Style) --}}
                @if($thread->image)
                  @php
                    // Parse JSON array or single string
                    $images = is_array($thread->image) ? $thread->image : json_decode($thread->image, true);
                    if (!is_array($images)) {
                      $images = [$thread->image];
                    }
                    // Normalize paths
                    $images = array_map(function($path) {
                      return str_replace('\\', '/', $path);
                    }, $images);
                    $images = array_filter($images);
                    $imageCount = count($images);
                  @endphp
                  
                  @if($imageCount > 0)
                    <div class="mb-4 w-full">
                      @if($imageCount == 1)
                        {{-- Single image: Large preview --}}
                        <div class="rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          <div class="w-full bg-gray-50" style="max-height: 350px;">
                            <img src="{{ asset('storage/' . $images[0]) }}" alt="Preview" class="w-full h-full object-cover">
                          </div>
                        </div>
                      @elseif($imageCount == 2)
                        {{-- 2 images: Side by side --}}
                        <div class="grid grid-cols-2 gap-2 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          @foreach($images as $img)
                            <div class="bg-gray-50" style="height: 250px;">
                              <img src="{{ asset('storage/' . $img) }}" alt="Preview" class="w-full h-full object-cover">
                            </div>
                          @endforeach
                        </div>
                      @elseif($imageCount == 3)
                        {{-- 3 images: 2 on top + 1 bottom (Facebook style) --}}
                        <div class="rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          {{-- Top row: 2 images --}}
                          <div class="grid grid-cols-2 gap-2">
                            @foreach(array_slice($images, 0, 2) as $img)
                              <div class="bg-gray-50" style="height: 180px;">
                                <img src="{{ asset('storage/' . $img) }}" alt="Preview" class="w-full h-full object-cover">
                              </div>
                            @endforeach
                          </div>
                          {{-- Bottom row: 1 image full width --}}
                          <div class="mt-2 bg-gray-50" style="height: 140px;">
                            <img src="{{ asset('storage/' . $images[2]) }}" alt="Preview" class="w-full h-full object-cover">
                          </div>
                        </div>
                      @elseif($imageCount == 4)
                        {{-- 4 images: 2x2 grid --}}
                        <div class="grid grid-cols-2 gap-2 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          @foreach($images as $img)
                            <div class="bg-gray-50" style="height: 200px;">
                              <img src="{{ asset('storage/' . $img) }}" alt="Preview" class="w-full h-full object-cover">
                            </div>
                          @endforeach
                        </div>
                      @else
                        {{-- 5+ images: Facebook style - all visible --}}
                        <div class="rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          {{-- Top row: 2 larger images --}}
                          <div class="grid grid-cols-2 gap-2">
                            @foreach(array_slice($images, 0, 2) as $img)
                              <div class="bg-gray-50" style="height: 180px;">
                                <img src="{{ asset('storage/' . $img) }}" alt="Preview" class="w-full h-full object-cover">
                              </div>
                            @endforeach
                          </div>
                          {{-- Bottom row: 3 smaller images --}}
                          <div class="grid grid-cols-3 gap-2 mt-2">
                            @foreach(array_slice($images, 2, 3) as $index => $img)
                              <div class="relative bg-gray-50" style="height: 120px;">
                                <img src="{{ asset('storage/' . $img) }}" alt="Preview" class="w-full h-full object-cover">
                                @if($index == 2 && $imageCount > 5)
                                  <div class="absolute inset-0 bg-black/70 flex items-center justify-center backdrop-blur-sm">
                                    <span class="text-white text-xl font-bold">+{{ $imageCount - 5 }}</span>
                                  </div>
                                @endif
                              </div>
                            @endforeach
                          </div>
                        </div>
                      @endif
                    </div>
                  @endif
                @endif

                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium text-gray-700">{{ $authorName }}</span>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $thread->created_at->diffForHumans() }}</span>
                  </div>
                  
                  {{-- Like Button --}}
                  <button onclick="event.stopPropagation(); likeThread({{ $thread->thread_id }}, this)" 
                    class="like-btn flex items-center gap-1.5 px-2 py-1 rounded-lg hover:bg-rose-50 transition {{ $thread->isLikedBy(auth()->user()) ? 'text-rose-600' : 'text-gray-500' }}" 
                    data-thread-id="{{ $thread->thread_id }}" 
                    data-liked="{{ $thread->isLikedBy(auth()->user()) ? 'true' : 'false' }}">
                    <svg class="w-4 h-4 {{ $thread->isLikedBy(auth()->user()) ? 'fill-current' : '' }}" fill="{{ $thread->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="font-semibold likes-count">{{ number_format($thread->likes_count ?? 0) }}</span>
                  </button>

                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span class="font-semibold text-emerald-600">{{ number_format($thread->replies_count ?? 0) }}</span>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span>{{ number_format($thread->views_count ?? 0) }}</span>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
      {{ $threads->links() }}
    </div>
  @endif
    </div>

    {{-- Sidebar (Right) --}}
    <div class="lg:col-span-1 space-y-6">
      
      {{-- Thread Teraktif --}}
      <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl shadow-md border-2 border-emerald-300 overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-500 to-green-500 px-5 py-4">
          <div class="flex items-center justify-between">
            <h3 class="font-bold text-white text-lg flex items-center gap-2">
              <span class="text-2xl">🏆</span>
              Thread Teraktif
            </h3>
            <a href="{{ route('forum.index', ['sort' => 'popular']) }}" class="text-xs text-white/90 hover:text-white font-semibold flex items-center gap-1">
              Semua
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>

        @php
          // Popular threads berdasarkan kombinasi likes, replies, dan views
          $popularThreads = \App\Models\ForumThread::with(['author', 'category', 'likes'])
            ->withCount('replies')
            ->orderByRaw('(likes_count * 3 + replies_count * 2 + COALESCE(views_count, 0)) DESC')
            ->take(5)
            ->get();
        @endphp

        <div class="p-4 space-y-2">
          @foreach($popularThreads as $index => $popular)
            <a href="{{ route('forum.detail', $popular->thread_id) }}" class="flex items-center gap-3 p-3 bg-white rounded-lg hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 transition group border border-transparent hover:border-emerald-200">
              {{-- Ranking Badge --}}
              <div class="shrink-0">
                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow-sm
                  {{ $index === 0 ? 'bg-gradient-to-br from-emerald-400 to-emerald-600 text-white' : '' }}
                  {{ $index === 1 ? 'bg-gradient-to-br from-green-400 to-green-600 text-white' : '' }}
                  {{ $index === 2 ? 'bg-gradient-to-br from-teal-400 to-teal-600 text-white' : '' }}
                  {{ $index > 2 ? 'bg-gray-100 text-gray-600' : '' }}">
                  {{ $index + 1 }}
                </div>
              </div>
              
              {{-- Content --}}
              <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-sm text-gray-900 group-hover:text-emerald-700 transition line-clamp-1 mb-1">
                  {{ $popular->title }}
                </h4>
                <div class="flex items-center gap-2 text-xs text-gray-500">
                  <span class="flex items-center gap-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="font-medium text-emerald-600">{{ number_format($popular->replies_count) }}</span>
                  </span>
                  <span class="text-gray-300">•</span>
                  <span class="flex items-center gap-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ number_format($popular->views_count ?? 0) }}
                  </span>
                </div>
              </div>

              {{-- Arrow --}}
              <svg class="w-4 h-4 text-gray-300 group-hover:text-emerald-600 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          @endforeach
        </div>
      </div>

      {{-- Popular Topics --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center gap-2">
          <span class="text-xl">🔥</span>
          Topik Populer
        </h3>
        <div class="space-y-3">
          <a href="{{ route('forum.index', ['sort' => 'popular']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-emerald-50 transition group">
            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-700">Hama Wereng Padi</span>
            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
          <a href="{{ route('forum.index', ['sort' => 'popular']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-emerald-50 transition group">
            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-700">Pupuk Organik</span>
            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
          <a href="{{ route('forum.index', ['sort' => 'popular']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-emerald-50 transition group">
            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-700">Perawatan Tanaman</span>
            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>

      {{-- Tips Card --}}
      <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl shadow-sm border-2 border-emerald-200 p-6">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
            <span class="text-2xl">💡</span>
          </div>
          <h3 class="font-bold text-gray-900 text-lg">Tips Bertanya</h3>
        </div>
        <ul class="space-y-3 text-sm text-gray-700">
          <li class="flex items-start gap-2">
            <span class="text-emerald-600 font-bold shrink-0">✓</span>
            <span>Tulis judul yang jelas dan spesifik</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="text-emerald-600 font-bold shrink-0">✓</span>
            <span>Sertakan foto untuk memperjelas masalah</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="text-emerald-600 font-bold shrink-0">✓</span>
            <span>Jelaskan detail situasi Anda</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="text-emerald-600 font-bold shrink-0">✓</span>
            <span>Pilih kategori yang sesuai</span>
          </li>
        </ul>
      </div>

    </div>
  </div>

</div>

{{-- Floating Action Button --}}
<a href="{{ route('forum.add') }}" class="fixed bottom-6 right-6 z-50 inline-flex items-center gap-2 px-6 py-4 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition font-bold text-lg shadow-lg">
  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
  </svg>
  <span>Buat Thread</span>
</a>

<script>
// Like thread function
async function likeThread(threadId, button) {
  try {
    const response = await fetch(`/forum/${threadId}/like`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    const data = await response.json();

    if (data.success) {
      const likesCountEl = button.querySelector('.likes-count');
      const heartIcon = button.querySelector('svg');
      
      // Update counter
      likesCountEl.textContent = data.likes_count.toLocaleString();
      
      // Update button state
      if (data.liked) {
        button.classList.add('text-rose-600');
        button.classList.remove('text-gray-500');
        heartIcon.setAttribute('fill', 'currentColor');
        heartIcon.classList.add('fill-current');
        button.setAttribute('data-liked', 'true');
      } else {
        button.classList.remove('text-rose-600');
        button.classList.add('text-gray-500');
        heartIcon.setAttribute('fill', 'none');
        heartIcon.classList.remove('fill-current');
        button.setAttribute('data-liked', 'false');
      }
      
      // Update all like buttons for this thread on the page
      document.querySelectorAll(`[data-thread-id="${threadId}"]`).forEach(btn => {
        const count = btn.querySelector('.likes-count');
        const icon = btn.querySelector('svg');
        if (count) count.textContent = data.likes_count.toLocaleString();
        if (icon) {
          if (data.liked) {
            btn.classList.add('text-rose-600');
            btn.classList.remove('text-gray-500');
            icon.setAttribute('fill', 'currentColor');
            icon.classList.add('fill-current');
          } else {
            btn.classList.remove('text-rose-600');
            btn.classList.add('text-gray-500');
            icon.setAttribute('fill', 'none');
            icon.classList.remove('fill-current');
          }
        }
        btn.setAttribute('data-liked', data.liked ? 'true' : 'false');
      });
    } else {
      if (response.status === 401) {
        setTimeout(() => {
          window.location.href = '/login';
        }, 1000);
      }
    }
  } catch (error) {
    console.error('Error:', error);
  }
}
</script>

</x-layout>
