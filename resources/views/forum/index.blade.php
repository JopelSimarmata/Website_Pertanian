<x-layout>
<x-navbar></x-navbar>

<style>
  .thread-card {
    transition: all 0.3s ease;
    cursor: pointer;
  }
  .thread-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(5, 150, 105, 0.15);
  }
  .category-chip {
    transition: all 0.2s ease;
  }
  .category-chip:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
  }
  .floating-btn {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 50;
    animation: pulse-ring 2s infinite;
  }
  @keyframes pulse-ring {
    0%, 100% { box-shadow: 0 0 0 0 hsla(160, 84%, 39%, 0.70); }
    50% { box-shadow: 0 0 0 20px rgba(16, 185, 129, 0); }
  }
  .search-highlight {
    transition: all 0.3s ease;
  }
  .search-highlight:focus-within {
    transform: scale(1.01);
    box-shadow: 0 8px 30px rgba(5, 150, 105, 0.15);
  }
  @keyframes slideIn {
    from { transform: translateX(400px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
  .toast {
    animation: slideIn 0.3s ease-out;
  }
  .help-badge {
    animation: bounce 2s infinite;
  }
  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
  }
</style>

{{-- Hero Section - Clean & Simple --}}
<div class="bg-gradient-to-r from-emerald-600 to-green-600 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Welcome Header --}}
    <div class="text-center mb-10">
      <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-5 py-2 rounded-full mb-4">
        <span class="text-2xl">🌾</span>
        <span class="text-sm font-semibold">Komunitas Petani Indonesia</span>
      </div>
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Forum Diskusi</h1>
      <p class="text-xl text-emerald-50 max-w-2xl mx-auto mb-2">Punya pertanyaan tentang pertanian?</p>
      <p class="text-lg text-emerald-100">Tanya di sini, kami siap membantu! 💪</p>
    </div>

    {{-- Big Search Bar --}}
    <div class="max-w-3xl mx-auto">
      <form action="{{ route('forum.index') }}" method="GET" class="search-highlight">
        <div class="relative">
          <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Contoh: Cara mengatasi hama wereng, pupuk terbaik untuk padi..."
            class="w-full px-6 py-5 pr-14 bg-white text-gray-900 rounded-2xl focus:outline-none focus:ring-4 focus:ring-white/50 text-base shadow-xl"
          >
          <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-3 bg-white text-emerald-600 rounded-xl hover:bg-emerald-50 transition shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </button>
        </div>
      </form>
      <p class="text-center text-emerald-100 text-sm mt-3">💡 Cari topik yang kamu butuhkan atau lihat diskusi populer di bawah</p>
    </div>

  </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Categories - Horizontal Scroll --}}
  <div class="mb-8">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
        <span class="text-2xl">📂</span>
        Pilih Kategori
      </h2>
      <a href="{{ route('forum.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-semibold">Lihat Semua</a>
    </div>
    
    <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide">
      <a href="{{ route('forum.index') }}" class="category-chip shrink-0 px-6 py-3 rounded-xl font-semibold transition {{ !request('category') ? 'bg-emerald-600 text-white' : 'bg-white border-2 border-gray-200 text-gray-700 hover:border-emerald-300' }}">
        🔥 Semua Topik
      </a>
      @foreach($categories as $cat)
        <a href="{{ route('forum.index', ['category' => $cat->category_id]) }}" class="category-chip shrink-0 px-6 py-3 rounded-xl font-semibold transition {{ request('category') == $cat->category_id ? 'bg-emerald-600 text-white' : 'bg-white border-2 border-gray-200 text-gray-700 hover:border-emerald-300' }}">
          {{ $cat->icon }} {{ $cat->name }}
        </a>
      @endforeach>
    </div>
  </div>

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
        <div class="thread-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" onclick="window.location='{{ route('forum.detail', $thread->thread_id) }}'">
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
                
                {{-- Badges --}}
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  @if($thread->is_pinned)
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-bold">
                      📌 Penting
                    </span>
                  @endif
                  @if($thread->is_solved)
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-bold">
                      ✅ Terjawab
                    </span>
                  @endif
                  @if($thread->category)
                    <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold">
                      {{ $thread->category->icon }} {{ $thread->category->name }}
                    </span>
                  @endif
                </div>
                
                {{-- Title --}}
                <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-emerald-600 transition line-clamp-2">
                  {{ $thread->title }}
                </h3>
                
                {{-- Excerpt --}}
                <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit(strip_tags($thread->content), 180) }}</p>

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
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span class="font-semibold text-emerald-600">{{ number_format($thread->replies_count ?? 0) }} Jawaban</span>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span>{{ number_format($thread->views_count ?? 0) }} views</span>
                  </div>
                </div>
              </div>

              {{-- Helper Badge for unsolved --}}
              @if(!$thread->is_solved && $thread->replies_count == 0)
                <div class="shrink-0">
                  <div class="help-badge bg-red-100 text-red-700 px-3 py-2 rounded-lg text-center">
                    <p class="text-xs font-bold">Butuh</p>
                    <p class="text-xs font-bold">Bantuan!</p>
                    <span class="text-lg">🆘</span>
                  </div>
                </div>
              @endif

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

{{-- Floating Action Button --}}
<a href="{{ route('forum.add') }}" class="floating-btn inline-flex items-center gap-2 px-6 py-4 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition font-bold text-lg shadow-2xl">
  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
  </svg>
  <span>Tanya Sekarang</span>
</a>

{{-- Toast Container --}}
<div id="toast-container" class="fixed top-6 right-6 z-50 space-y-2"></div>

<script>
// Smooth scroll
document.querySelectorAll('.thread-card').forEach(card => {
  card.addEventListener('click', function(e) {
    if (!e.target.closest('a')) {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  });
});

// Auto search submit with debounce
let searchTimeout;
const searchInput = document.querySelector('input[name="search"]');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const value = this.value.trim();
    
    if (value.length >= 3) {
      searchTimeout = setTimeout(() => {
        this.form.submit();
      }, 1000);
    }
  });
}

// Toast notification
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
    success: '✅',
    error: '❌',
    info: 'ℹ️',
    warning: '⚠️'
  };
  
  toast.className = `toast flex items-center gap-3 ${colors[type]} text-white px-5 py-4 rounded-xl shadow-2xl min-w-[300px]`;
  toast.innerHTML = `
    <span class="text-2xl">${icons[type]}</span>
    <span class="font-semibold">${message}</span>
  `;
  
  container.appendChild(toast);
  
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(400px)';
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// Welcome message for first visit
if (!sessionStorage.getItem('forumVisited')) {
  setTimeout(() => {
    showToast('Selamat datang di Forum! 👋', 'success');
    sessionStorage.setItem('forumVisited', 'true');
  }, 500);
}
</script>

<style>
  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }
  .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
</style>

</x-layout>
