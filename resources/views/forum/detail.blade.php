<x-layout>
<x-navbar></x-navbar>

<div class="max-w-7xl mx-auto px-6 py-12">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main content -->
    <div class="lg:col-span-2 space-y-6">
      <div class="bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-emerald-800 mb-3">{{ $thread->title }}</h1>

        <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
          <div class="flex items-center gap-3">
            @php
              $authorName = $thread->author->name ?? ('User #' . $thread->author_id);
              $email = $thread->author->email ?? null;
              $gravatar = $email ? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?s=48&d=identicon' : asset('images/default-avatar.png');
            @endphp
            <img src="{{ $gravatar }}" alt="avatar" class="w-8 h-8 rounded-full border">
            <div>
              <div class="text-sm text-gray-700">{{ $authorName }}</div>
              <div class="text-xs text-gray-400">{{ $thread->created_at->diffForHumans() }}</div>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="text-center">
              <div class="font-semibold text-gray-700 text-sm">{{ $thread->replies_count ?? $thread->replies->count() }}</div>
              <div class="text-xs text-gray-400">balasan</div>
            </div>
            <div class="text-center">
              <div class="font-semibold text-gray-700 text-sm">{{ $thread->views_count ?? 0 }}</div>
              <div class="text-xs text-gray-400">dilihat</div>
            </div>
          </div>
        </div>

        @if($thread->image ?? false)
          <div class="mb-4">
            <img src="{{ asset($thread->image) }}" alt="lampiran" class="w-full rounded-lg object-contain border">
          </div>
        @endif

        <div class="prose max-w-none text-gray-700 mb-4">
          {!! nl2br(e($thread->content)) !!}
        </div>

        @if($thread->tags && count($thread->tags))
          <div class="flex flex-wrap gap-2 mb-4">
            @foreach($thread->tags as $tag)
              <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">{{ $tag->name }}</span>
            @endforeach
          </div>
        @endif

        <div class="flex items-center gap-3">
          <form method="POST" action="{{ route('forum.like', $thread->id) }}">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border hover:bg-gray-50 text-sm">
              ❤ Suka
            </button>
          </form>

          <form method="POST" action="{{ route('forum.bookmark', $thread->id) }}">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border hover:bg-gray-50 text-sm">
              🔖 Simpan
            </button>
          </form>

          <a href="{{ route('forum.index') }}" class="ml-auto text-sm text-emerald-600 hover:underline">Kembali ke Forum</a>
        </div>
      </div>

      <!-- Replies list -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Balasan ({{ $thread->replies_count ?? $thread->replies->count() }})</h2>

        @if($thread->replies && $thread->replies->count())
          <div class="space-y-4">
            @foreach($thread->replies as $reply)
              @php
                $rAuthor = $reply->author ?? null;
                $rEmail = $rAuthor->email ?? null;
                $rGravatar = $rEmail ? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($rEmail))) . '?s=40&d=identicon' : asset('images/default-avatar.png');
              @endphp

              <div class="flex gap-4">
                <img src="{{ $rGravatar }}" alt="avatar" class="w-10 h-10 rounded-full border">
                <div class="flex-1">
                  <div class="flex items-start justify-between">
                    <div>
                      <div class="text-sm font-medium text-gray-800">{{ $rAuthor->name ?? ('User #' . $reply->author_id) }}</div>
                      <div class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</div>
                    </div>
                  </div>

                  <div class="mt-2 text-gray-700 text-sm">
                    {!! nl2br(e($reply->content)) !!}
                  </div>

                  @if($reply->image ?? false)
                    <div class="mt-3">
                      <img src="{{ asset($reply->image) }}" alt="reply-image" class="w-48 rounded border object-cover">
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>

          {{-- If replies are paginated --}}
          @if(method_exists($thread->replies, 'links'))
            <div class="mt-4">
              {{ $thread->replies->links() }}
            </div>
          @endif
        @else
          <div class="text-sm text-gray-500">Belum ada balasan. Jadilah yang pertama menjawab.</div>
        @endif
      </div>

      <!-- Reply form -->
      <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-medium text-gray-800 mb-3">Tulis Balasan</h3>

        @auth
          <form action="{{ route('forum.reply', $thread->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <textarea name="content" rows="4" required class="w-full rounded-md border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" placeholder="Tulis jawaban atau tanggapan...">{{ old('content') }}</textarea>
            <div class="flex items-center gap-3">
              <input type="file" name="image" accept="image/*" class="text-sm text-gray-600">
              <div class="ml-auto">
                <button type="submit" class="px-4 py-2 rounded-md bg-emerald-600 text-white hover:bg-emerald-700 text-sm">Kirim</button>
              </div>
            </div>
          </form>
        @else
          <div class="text-sm text-gray-600">Silakan <a href="{{ route('login') }}" class="text-emerald-600 hover:underline">masuk</a> untuk memberi balasan.</div>
        @endauth
      </div>
    </div>

    <!-- Sidebar -->
    <aside class="space-y-4">
      <div class="bg-white rounded-xl shadow p-4">
        <h4 class="text-sm text-gray-500 mb-2">Informasi Thread</h4>
        <div class="text-sm text-gray-700">
          <div class="flex items-center justify-between py-2 border-b">
            <div class="text-gray-500">Penulis</div>
            <div class="font-medium">{{ $authorName }}</div>
          </div>
          <div class="flex items-center justify-between py-2 border-b">
            <div class="text-gray-500">Dibuat</div>
            <div class="text-gray-500 text-sm">{{ $thread->created_at->format('d M Y H:i') }}</div>
          </div>
          <div class="flex items-center justify-between py-2">
            <div class="text-gray-500">Dilihat</div>
            <div class="font-medium">{{ $thread->views_count ?? 0 }}</div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow p-4">
        <h4 class="text-sm text-gray-500 mb-2">Kategori</h4>
        <div class="flex flex-wrap gap-2">
          @if($thread->category)
            <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">{{ $thread->category->name }}</span>
          @endif
        </div>
      </div>
    </aside>
  </div>
</div>

</x-layout>