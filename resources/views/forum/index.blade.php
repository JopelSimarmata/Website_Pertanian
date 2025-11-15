<x-layout>

<x-navbar></x-navbar>

  <!-- Hero / header sesuai desain -->
  <div class="bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6 py-10">
      <h1 class="text-2xl font-bold text-emerald-800">Forum Diskusi Pertanian</h1>
      <p class="mt-2 text-sm text-emerald-700/80">Berbagi pengalaman dan pengetahuan dengan sesama petani</p>

      <!-- Search + filters bar -->
      <div class="mt-6 flex flex-col md:flex-row items-center gap-4">
        <form id="forum-filter" method="GET" action="{{ route('forum.index') }}" class="flex-1 flex gap-3 items-center">
          <label for="q" class="sr-only">Cari diskusi</label>
          <div class="flex items-center w-full bg-white rounded-full shadow-sm border border-emerald-100 px-4 py-2">
            <svg class="w-5 h-5 text-emerald-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"></path></svg>
            <input id="q" name="q" value="{{ request('q') }}" placeholder="Cari diskusi..." class="w-full border-0 focus:ring-0 focus:outline-none text-sm" />
          </div>

          <button type="submit" class="ml-2 inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm">
            Cari
          </button>
        </form>

        <div class="flex items-center gap-3">
          <select name="category" onchange="document.getElementById('forum-filter').submit()" form="forum-filter" class="bg-white border rounded-full px-4 py-2 text-sm">
            <option value="">Semua Kategori</option>
            @foreach($categories ?? [] as $cat)
              <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>

          <select name="status" onchange="document.getElementById('forum-filter').submit()" form="forum-filter" class="bg-white border rounded-full px-4 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="open" {{ request('status')=='open' ? 'selected' : '' }}>Terbuka</option>
            <option value="resolved" {{ request('status')=='resolved' ? 'selected' : '' }}>Terselesaikan</option>
          </select>

          <a href="{{ route('forum.add') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-full text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Diskusi
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-6 py-8">
    @if(session('success'))
      <div class="mb-4 rounded-md bg-green-50 p-3 text-green-800">{{ session('success') }}</div>
    @endif

    @if(!isset($threads) || $threads->isEmpty())
      <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-500">
        Belum ada thread. Jadilah yang pertama membuat diskusi!
      </div>
    @else
      <div class="space-y-4">
        @foreach($threads as $thread)
          @php
            $payload = [
              'id' => $thread->id,
              'liked' => $thread->is_liked ?? false,
              'bookmarked' => $thread->is_bookmarked ?? false,
              // kirim model (atau id) sesuai route parameter agar tidak terjadi missing parameter
              'likeUrl' => route('forum.like', $thread),
              'bookmarkUrl' => route('forum.bookmark', $thread),
            ];
          @endphp

          <article
            x-data='threadCard(@json($payload))'
            class="bg-white rounded-xl shadow p-4"
          >
            <div class="flex items-start justify-between">
              <div class="flex-1 pr-4">
                <a href="{{ route('forum.detail', $thread) }}" class="text-lg font-semibold text-emerald-800 hover:underline">{{ $thread->title }}</a>

                <p class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($thread->content), 200) }}</p>

                <div class="mt-3 text-xs text-gray-400 flex items-center gap-3">
                  <div class="flex items-center gap-2">
                    @php
                      $authorName = $thread->author->name ?? ('User #' . $thread->author_id);
                      $email = $thread->author->email ?? null;
                      $gravatar = $email ? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?s=40&d=identicon' : asset('images/default-avatar.png');
                    @endphp
                    <img src="{{ $gravatar }}" alt="avatar" class="w-6 h-6 rounded-full border">
                    <span>Dipost oleh: {{ $authorName }}</span>
                  </div>

                  <div>•</div>
                  <div>{{ $thread->created_at->diffForHumans() }}</div>
                </div>

                @if($thread->tags && count($thread->tags))
                  <div class="mt-3 flex flex-wrap gap-2">
                    @foreach($thread->tags as $tag)
                      <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-1 rounded-full">{{ $tag->name }}</span>
                    @endforeach
                  </div>
                @endif
              </div>

              <div class="ml-4 text-right text-sm text-gray-500 flex flex-col items-end gap-3">
                <div class="text-center">
                  <div class="font-semibold text-gray-700">{{ $thread->replies_count ?? 0 }}</div>
                  <div class="text-xs text-gray-400">balasan</div>
                </div>
                <div class="text-center">
                  <div class="font-semibold text-gray-700">{{ $thread->views_count ?? 0 }}</div>
                  <div class="text-xs text-gray-400">dilihat</div>
                </div>

                <div class="flex gap-2 mt-2">
                  <button
                    x-text="liked ? '❤' : '♡'"
                    x-bind:class="liked ? 'text-red-500' : 'text-gray-500'"
                    @click.prevent="toggleLike"
                    class="px-3 py-1 rounded-md border hover:bg-gray-50 cursor-pointer"
                    aria-label="like"
                  ></button>

                  <button
                    x-text="bookmarked ? '🔖' : '📑'"
                    @click.prevent="toggleBookmark"
                    class="px-3 py-1 rounded-md border hover:bg-gray-50 cursor-pointer"
                    aria-label="bookmark"
                  ></button>
                </div>
              </div>
            </div>
          </article>
        @endforeach

        <!-- Pagination -->
        <div class="mt-6">
          @if(method_exists($threads, 'withQueryString'))
            {{ $threads->withQueryString()->links() }}
          @elseif(method_exists($threads, 'links'))
            {{ $threads->links() }}
          @endif
        </div>
      </div>
    @endif
  </div>

  <!-- Alpine + JS for AJAX interactions -->
  <script>
    (function(){
      if (!window.Alpine) {
        const s = document.createElement('script');
        s.src = 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js';
        s.defer = true;
        document.head.appendChild(s);
      }

      window.threadCard = function(data){
        return {
          id: data.id,
          liked: !!data.liked,
          bookmarked: !!data.bookmarked,
          likeUrl: data.likeUrl,
          bookmarkUrl: data.bookmarkUrl,
          async toggleLike(){
            try{
              const meta = document.querySelector('meta[name="csrf-token"]');
              const token = meta ? meta.getAttribute('content') : null;
              const res = await fetch(this.likeUrl, {
                method: 'POST',
                headers: {
                  ...(token ? {'X-CSRF-TOKEN': token} : {}),
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
              });
              if(res.ok){
                const json = await res.json().catch(()=>({}));
                this.liked = ('liked' in json) ? !!json.liked : !this.liked;
              } else {
                console.error('Gagal like', res.status);
              }
            } catch(e){ console.error(e); }
          },
          async toggleBookmark(){
            try{
              const meta = document.querySelector('meta[name="csrf-token"]');
              const token = meta ? meta.getAttribute('content') : null;
              const res = await fetch(this.bookmarkUrl, {
                method: 'POST',
                headers: {
                  ...(token ? {'X-CSRF-TOKEN': token} : {}),
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
              });
              if(res.ok){
                const json = await res.json().catch(()=>({}));
                this.bookmarked = ('bookmarked' in json) ? !!json.bookmarked : !this.bookmarked;
              } else {
                console.error('Gagal bookmark', res.status);
              }
            } catch(e){ console.error(e); }
          }
        }
      };
    })();
  </script>

</x-layout>