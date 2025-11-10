<x-layout>
<x-navbar></x-navbar>
// Detail view for a forum thread with full content display with comment section can be added here.

<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-emerald-800 mb-4">{{ $thread->title }}</h1>
        <div class="text-gray-700 mb-6">
            {!! nl2br(e($thread->content)) !!}
        </div>
        <div class="text-xs text-gray-400">Dipost oleh: {{ $thread->author_id }} • {{ $thread->created_at->diffForHumans() }}</div>
    </div>
</div>





</x-layout>