<x-layout>
<x-navbar></x-navbar>

<style>
  .thread-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .thread-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px -4px rgba(0, 0, 0, 0.08);
  }
  .like-btn.liked svg {
    fill: #ef4444;
    stroke: #ef4444;
  }
  .bookmark-btn.bookmarked svg {
    fill: #f59e0b;
    stroke: #f59e0b;
  }
  .stat-card {
    transition: transform 0.3s ease;
  }
  .stat-card:hover {
    transform: scale(1.05);
  }
  @keyframes slideIn {
    from {
      transform: translateX(400px);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }
  .toast {
    animation: slideIn 0.3s ease-out;
  }
  .search-spinner {
    animation: spin 1s linear infinite;
  }
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Header --}}
  <div class="bg-gradient-to-r from-emerald-600 to-green-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
      <div>
        <h1 class="text-3xl font-bold mb-2">Forum Diskusi Pertanian</h1>
        <p class="text-emerald-50">Berbagi pengalaman, bertanya, dan belajar bersama komunitas petani</p>
      </div>
      <a href="{{ route('forum.add') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-emerald-600 rounded-xl font-semibold hover:bg-emerald-50 transition shadow-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Buat Thread Baru
      </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
      <div class="stat-card bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 cursor-pointer">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
          </div>
          <div>
            <p class="text-2xl font-bold">{{ number_format($totalThreads) }}</p>
            <p class="text-sm text-emerald-100">Thread</p>
          </div>
        </div>
      </div>
      <div class="stat-card bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 cursor-pointer">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
          </div>
          <div>
            <p class="text-2xl font-bold">{{ number_format($totalReplies) }}</p>
            <p class="text-sm text-emerald-100">Balasan</p>
          </div>
        </div>
      </div>
      <div class="stat-card bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 cursor-pointer">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
          <div>
            <p class="text-2xl font-bold">{{ number_format($totalMembers) }}</p>
            <p class="text-sm text-emerald-100">Anggota</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    
    {{-- Sidebar --}}
    <div class="lg:col-span-1 space-y-6">
      
      {{-- Search --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
        <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          Cari Thread
        </h3>
        <form method="GET" action="{{ route('forum.index') }}">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 text-sm">
          <button type="submit" class="w-full mt-2 px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-medium text-sm">Cari</button>
        </form>
      </div>

      {{-- Categories --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
          </svg>
          Kategori
        </h3>
        <div class="space-y-2">
          <a href="{{ route('forum.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition {{ !request('category') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-700' }}">
            <span class="text-sm">Semua Kategori</span>
            <span class="text-xs px-2 py-1 bg-gray-100 rounded-full">{{ $totalThreads }}</span>
          </a>
          @foreach($categories as $cat)
            <a href="{{ route('forum.index', ['category' => $cat->category_id]) }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition {{ request('category') == $cat->category_id ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-700' }}">
              <span class="text-sm">{{ $cat->name }}</span>
              <span class="text-xs px-2 py-1 bg-gray-100 rounded-full">{{ $cat->threads_count ?? 0 }}</span>
            </a>
          @endforeach
        </div>
      </div>

      {{-- Quick Links --}}
      <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl shadow-sm border border-emerald-100 p-4">
        <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
          Tautan Cepat
        </h3>
        <div class="space-y-2">
          <a href="{{ route('forum.index', ['sort' => 'popular']) }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-emerald-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
            </svg>
            Thread Populer
          </a>
          <a href="{{ route('forum.index', ['filter' => 'solved']) }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-emerald-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Thread Terjawab
          </a>
          <a href="{{ route('forum.index', ['filter' => 'unsolved']) }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-emerald-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Butuh Bantuan
          </a>
        </div>
      </div>
    </div>

    {{-- Main Content --}}
    <div class="lg:col-span-3">
      
      @if(request('search'))
        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
          <p class="text-sm text-blue-800">Hasil pencarian untuk: <span class="font-bold">{{ request('search') }}</span></p>
        </div>
      @endif

      @if($threads->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Thread</h3>
          <p class="text-gray-600 mb-6">Jadilah yang pertama memulai diskusi!</p>
          <a href="{{ route('forum.add') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Thread Baru
          </a>
        </div>
      @else
        <div class="space-y-4">
          @foreach($threads as $thread)
            <div class="thread-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-thread-id="{{ $thread->thread_id }}">
              <div class="p-6">
                <div class="flex items-start gap-4">
                  
                  {{-- Author Avatar --}}
                  <div class="shrink-0">
                    @php
                      $authorName = $thread->author->name ?? 'User';
                      $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&color=059669&background=d1fae5&size=48';
                    @endphp
                    <img src="{{ $avatar }}" alt="{{ $authorName }}" class="w-12 h-12 rounded-full border-2 border-emerald-100">
                  </div>

                  {{-- Thread Content --}}
                  <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4 mb-2">
                      <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                          @if($thread->is_pinned)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-amber-100 text-amber-700 rounded-md text-xs font-semibold">
                              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path>
                              </svg>
                              Pinned
                            </span>
                          @endif
                          @if($thread->is_solved)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-md text-xs font-semibold">
                              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                              </svg>
                              Terjawab
                            </span>
                          @endif
                          @if($thread->category)
                            <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-700 rounded-md text-xs font-medium">
                              {{ $thread->category->name }}
                            </span>
                          @endif
                        </div>
                        
                        <a href="{{ route('forum.detail', $thread->thread_id) }}" class="text-lg font-bold text-gray-900 hover:text-emerald-600 transition line-clamp-2">
                          {{ $thread->title }}
                        </a>
                        
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ Str::limit(strip_tags($thread->content), 150) }}</p>
                      </div>

                      {{-- Like & Bookmark Actions --}}
                      <div class="flex items-center gap-2">
                        <button class="like-btn p-2 rounded-lg hover:bg-gray-100 transition" data-thread-id="{{ $thread->thread_id }}" title="Suka">
                          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                          </svg>
                        </button>
                        <button class="bookmark-btn p-2 rounded-lg hover:bg-gray-100 transition" data-thread-id="{{ $thread->thread_id }}" title="Simpan">
                          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                          </svg>
                        </button>
                      </div>
                    </div>

                    {{-- Meta Info --}}
                    <div class="flex flex-wrap items-center gap-4 mt-3 text-sm text-gray-500">
                      <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">{{ $authorName }}</span>
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

  </div>

</div>

{{-- Toast Notification Container --}}
<div id="toast-container" class="fixed top-6 right-6 z-50 space-y-2"></div>

<script>
// Initialize localStorage for likes and bookmarks
const likes = JSON.parse(localStorage.getItem('forumLikes') || '[]');
const bookmarks = JSON.parse(localStorage.getItem('forumBookmarks') || '[]');

// Apply saved states on page load
document.addEventListener('DOMContentLoaded', () => {
  // Apply likes
  likes.forEach(threadId => {
    const likeBtn = document.querySelector(`.like-btn[data-thread-id="${threadId}"]`);
    if (likeBtn) {
      likeBtn.classList.add('liked');
      likeBtn.querySelector('svg').style.fill = '#ef4444';
      likeBtn.querySelector('svg').style.stroke = '#ef4444';
    }
  });

  // Apply bookmarks
  bookmarks.forEach(threadId => {
    const bookmarkBtn = document.querySelector(`.bookmark-btn[data-thread-id="${threadId}"]`);
    if (bookmarkBtn) {
      bookmarkBtn.classList.add('bookmarked');
      bookmarkBtn.querySelector('svg').style.fill = '#f59e0b';
      bookmarkBtn.querySelector('svg').style.stroke = '#f59e0b';
    }
  });
});

// Like button functionality
document.querySelectorAll('.like-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const threadId = this.getAttribute('data-thread-id');
    const svg = this.querySelector('svg');
    const isLiked = this.classList.contains('liked');
    
    if (isLiked) {
      // Unlike
      this.classList.remove('liked');
      svg.style.fill = 'none';
      svg.style.stroke = 'currentColor';
      const index = likes.indexOf(threadId);
      if (index > -1) likes.splice(index, 1);
      showToast('Thread tidak disukai', 'info');
    } else {
      // Like
      this.classList.add('liked');
      svg.style.fill = '#ef4444';
      svg.style.stroke = '#ef4444';
      likes.push(threadId);
      showToast('Thread disukai!', 'success');
    }
    
    localStorage.setItem('forumLikes', JSON.stringify(likes));
  });
});

// Bookmark button functionality
document.querySelectorAll('.bookmark-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const threadId = this.getAttribute('data-thread-id');
    const svg = this.querySelector('svg');
    const isBookmarked = this.classList.contains('bookmarked');
    
    if (isBookmarked) {
      // Remove bookmark
      this.classList.remove('bookmarked');
      svg.style.fill = 'none';
      svg.style.stroke = 'currentColor';
      const index = bookmarks.indexOf(threadId);
      if (index > -1) bookmarks.splice(index, 1);
      showToast('Bookmark dihapus', 'info');
    } else {
      // Add bookmark
      this.classList.add('bookmarked');
      svg.style.fill = '#f59e0b';
      svg.style.stroke = '#f59e0b';
      bookmarks.push(threadId);
      showToast('Thread disimpan!', 'success');
    }
    
    localStorage.setItem('forumBookmarks', JSON.stringify(bookmarks));
  });
});

// Live search with debounce
let searchTimeout;
const searchInput = document.querySelector('input[name="search"]');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const value = this.value;
    
    if (value.length >= 2) {
      // Show loading indicator
      this.classList.add('search-loading');
      
      searchTimeout = setTimeout(() => {
        this.form.submit();
      }, 800);
    }
  });
}

// Toast notification system
function showToast(message, type = 'info') {
  const container = document.getElementById('toast-container');
  const toast = document.createElement('div');
  
  const colors = {
    success: 'bg-emerald-500',
    error: 'bg-red-500',
    info: 'bg-blue-500',
    warning: 'bg-amber-500'
  };
  
  const icons = {
    success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
    error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>',
    info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
    warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>'
  };
  
  toast.className = `toast flex items-center gap-3 ${colors[type]} text-white px-4 py-3 rounded-lg shadow-lg min-w-[280px]`;
  toast.innerHTML = `
    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      ${icons[type]}
    </svg>
    <span class="font-medium">${message}</span>
  `;
  
  container.appendChild(toast);
  
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(400px)';
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    if (href !== '#') {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    }
  });
});
</script>

</x-layout>