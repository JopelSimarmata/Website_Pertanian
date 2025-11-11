<x-layout>

<x-navbar></x-navbar>

  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-emerald-800">Forum</h1>
      <a href="{{ route('forum.add') }}" class="inline-block rounded-md bg-emerald-600 text-white px-4 py-2 hover:bg-emerald-500">Buat Thread</a>
    </div>

    @if(session('success'))
      <div class="mb-4 rounded-md bg-green-50 p-3 text-green-800">{{ session('success') }}</div>
    @endif

    @if($threads->isEmpty())
      <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-500">
        Belum ada thread. Jadilah yang pertama membuat diskusi!
      </div>
    @else
      <div class="space-y-4">
        @foreach($threads as $thread)
          <article class="bg-white rounded-xl shadow p-4">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <a href="/forum" class="text-lg font-semibold text-emerald-800 hover:underline">{{ $thread->title }}</a>
                <p class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($thread->content), 200) }}</p>
                <div class="mt-3 text-xs text-gray-400">Dipost oleh: {{ $thread->author_id }} • {{ $thread->created_at->diffForHumans() }}</div>
              </div>
              <div class="ml-4 text-right text-sm text-gray-500">
                <div>{{ $thread->replies_count ?? 0 }} balasan</div>
                <div class="mt-2">{{ $thread->views_count ?? 0 }} dilihat</div>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </div>
</x-layout>