<x-layout>
<x-navbar></x-navbar>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Back Button --}}
  <div class="mb-6">
    <a href="{{ route('forum.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-emerald-300 transition font-medium">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Kembali ke Forum</span>
    </a>
  </div>

  {{-- Main Thread --}}
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    
    {{-- Thread Header --}}
    <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-100">
      <div class="flex items-start justify-between gap-4 mb-4">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-3">
            @if($thread->is_pinned)
              <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-semibold">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path>
                </svg>
                Thread Dipinned
              </span>
            @endif
            @if($thread->is_solved)
              <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Terjawab
              </span>
            @endif
            @if($thread->category)
              <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold">
                {{ $thread->category->name }}
              </span>
            @endif
          </div>

          <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $thread->title }}</h1>

          <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              @php
                $authorName = $thread->author->name ?? 'User';
                $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&color=059669&background=d1fae5&size=32';
              @endphp
              <img src="{{ $avatar }}" alt="{{ $authorName }}" class="w-8 h-8 rounded-full border-2 border-emerald-100">
              <span class="font-semibold text-gray-900">{{ $authorName }}</span>
            </div>
            <div class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <span>{{ $thread->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
              <span>{{ number_format($thread->views_count ?? 0) }} views</span>
            </div>
            <div class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
              </svg>
              <span>{{ number_format($thread->replies_count ?? 0) }} balasan</span>
            </div>
          </div>
        </div>

        {{-- Actions --}}
        @auth
          @if(auth()->id() === $thread->author_id || auth()->user()->role === 'admin')
            <div class="flex gap-2">
              <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </button>
              <button class="p-2 text-red-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
              </button>
            </div>
          @endif
        @endauth
      </div>
    </div>

    {{-- Thread Content --}}
    <div class="p-8">
      <div class="prose max-w-none text-gray-700 leading-relaxed">
        {!! nl2br(e($thread->content)) !!}
      </div>

      {{-- Tags --}}
      @if($thread->tags && count($thread->tags) > 0)
        <div class="flex flex-wrap gap-2 mt-6 pt-6 border-t border-gray-100">
          <span class="text-sm text-gray-500 font-medium">Tags:</span>
          @foreach($thread->tags as $tag)
            <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200 transition cursor-pointer">
              #{{ $tag }}
            </span>
          @endforeach
        </div>
      @endif
    </div>
  </div>

  {{-- Replies Section --}}
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gray-50 px-8 py-4 border-b border-gray-200">
      <h2 class="text-xl font-bold text-gray-900">
        {{ number_format($thread->replies_count ?? 0) }} Balasan
      </h2>
    </div>

    <div class="p-8">
      {{-- Reply Form --}}
      @auth
        <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl p-6 border-2 border-emerald-100 mb-8">
          <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            Tulis Balasan
          </h3>
          <form action="#" method="POST">
            @csrf
            <textarea 
              name="reply" 
              rows="4" 
              class="w-full px-4 py-3 border-2 border-emerald-200 rounded-xl focus:outline-none focus:border-emerald-500 transition resize-none bg-white" 
              placeholder="Bagikan pendapat atau solusi Anda..."
              required
            ></textarea>
            <div class="flex justify-end mt-3">
              <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-semibold shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Kirim Balasan
              </button>
            </div>
          </form>
        </div>
      @else
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 text-center mb-8">
          <svg class="w-12 h-12 text-blue-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
          <p class="text-gray-700 mb-4">Login untuk ikut berdiskusi</p>
          <a href="{{ route('show.login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-semibold">
            Login Sekarang
          </a>
        </div>
      @endauth

      {{-- Replies List --}}
      @if(($thread->replies_count ?? 0) > 0)
        <div class="space-y-6">
          {{-- Sample Reply (loop ini nanti) --}}
          <div class="flex gap-4 pb-6 border-b border-gray-100 last:border-0">
            <div class="shrink-0">
              <img src="https://ui-avatars.com/api/?name=Sample+User&color=6366f1&background=e0e7ff&size=40" alt="User" class="w-10 h-10 rounded-full border-2 border-gray-100">
            </div>
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <span class="font-bold text-gray-900">Sample User</span>
                <span class="text-sm text-gray-500">2 jam yang lalu</span>
              </div>
              <p class="text-gray-700 leading-relaxed">Ini adalah contoh balasan. Data balasan akan diambil dari database nantinya.</p>
              <div class="flex items-center gap-4 mt-3">
                <button class="text-sm text-gray-500 hover:text-emerald-600 transition flex items-center gap-1">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                  </svg>
                  <span>Membantu</span>
                </button>
                <button class="text-sm text-gray-500 hover:text-emerald-600 transition">
                  Balas
                </button>
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="text-center py-12">
          <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
          </svg>
          <p class="text-gray-500 font-medium">Belum ada balasan</p>
          <p class="text-sm text-gray-400 mt-1">Jadilah yang pertama memberikan komentar!</p>
        </div>
      @endif
    </div>
  </div>

</div>

</x-layout>