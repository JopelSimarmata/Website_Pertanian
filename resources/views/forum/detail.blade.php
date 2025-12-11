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
    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-100">
      <div class="flex items-start justify-between gap-4 mb-3">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-2">
            @if($thread->is_pinned)
              <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-semibold">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path>
                </svg>
                Thread Dipinned
              </span>
            @endif
            
            @if($thread->is_solved)
              <span class="thread-status-badge inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Terjawab
              </span>
            @else
              <span class="thread-status-badge inline-flex items-center gap-1 px-2.5 py-1 bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold">
                Belum Terjawab
              </span>
            @endif
            
            @if($thread->category)
              <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold">
                {{ $thread->category->name }}
              </span>
            @endif
          </div>

          <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $thread->title }}</h1>

          <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              @php
                $authorName = $thread->author->name ?? 'User';
                // Check if user has uploaded avatar
                $hasAvatar = $thread->author->profile && $thread->author->profile->avatar;
                if ($hasAvatar) {
                  $avatar = asset('storage/' . $thread->author->profile->avatar);
                } else {
                  $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&color=ffffff&background=059669&size=32';
                }
              @endphp
              <img src="{{ $avatar }}" alt="{{ $authorName }}" class="w-8 h-8 rounded-full border-2 border-emerald-100 object-cover">
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
              <span>{{ number_format($thread->views_count ?? 0) }}</span>
            </div>
          </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col gap-2">
          @auth
            {{-- Edit/Delete Buttons --}}
            @if(auth()->id() === $thread->author_id || auth()->user()->role === 'admin')
              <div class="flex gap-1.5 justify-center">
                <a href="{{ route('forum.edit', $thread->thread_id) }}" class="p-2 text-gray-500 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                </a>
                <button onclick="confirmDelete({{ $thread->thread_id }})" class="p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            @endif
          @endauth
        </div>
      </div>
    </div>

    {{-- Thread Content --}}
    <div class="px-6 pt-3 pb-2">
      <div class="prose max-w-none text-gray-700 leading-relaxed">
        {!! nl2br(e($thread->content)) !!}
      </div>

      {{-- Tags --}}
      @if($thread->tags)
        @php
          $threadTags = is_array($thread->tags) ? $thread->tags : json_decode($thread->tags, true);
        @endphp
        @if($threadTags && is_array($threadTags) && count($threadTags) > 0)
          <div class="flex flex-wrap gap-2 mt-1 pt-1 border-t border-gray-100">
            <span class="text-sm text-gray-500 font-medium">Tags:</span>
            @foreach($threadTags as $tag)
              <span class="inline-flex items-center px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium">
                #{{ $tag }}
              </span>
            @endforeach
          </div>
        @endif
      @endif

      {{-- Image Attachment --}}
      @if($thread->image)
        @php
          // Decode JSON and handle different formats
          $images = is_array($thread->image) ? $thread->image : json_decode($thread->image, true);
          
          if (!is_array($images) || empty($images)) {
            // If JSON decode fails or empty, check if it's a single string path
            if (is_string($thread->image) && !empty($thread->image)) {
              $images = [$thread->image];
            } else {
              $images = [];
            }
          }
          
          // Normalize paths (convert backslashes to forward slashes)
          $images = array_map(function($path) {
            return str_replace('\\', '/', $path);
          }, $images);
          
          // Filter out empty values
          $images = array_filter($images);
          $imageCount = count($images);
        @endphp
        
        @if($imageCount > 0)
        
        <div class="mt-6 pt-6 border-t border-gray-100">
          <div class="flex items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-sm font-semibold text-gray-700">{{ $imageCount }} Foto</span>
          </div>
          
          {{-- Facebook-style Grid Layout --}}
          @if($imageCount == 1)
            {{-- Single image: Large display --}}
            <div class="rounded-xl overflow-hidden border border-gray-200 cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $images[0]) }}')">
              <img src="{{ asset('storage/' . $images[0]) }}" alt="Photo 1" class="w-full h-auto max-h-[500px] object-cover">
            </div>
          @elseif($imageCount == 2)
            {{-- 2 images: Side by side --}}
            <div class="grid grid-cols-2 gap-1 rounded-xl overflow-hidden border border-gray-200">
              @foreach($images as $index => $img)
                <div class="aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $img) }}')">
                  <img src="{{ asset('storage/' . $img) }}" alt="Photo {{ $index + 1 }}" class="w-full h-full object-cover">
                </div>
              @endforeach
            </div>
          @elseif($imageCount == 3)
            {{-- 3 images: 2 on top + 1 bottom full width --}}
            <div class="rounded-xl overflow-hidden border border-gray-200">
              {{-- Top row: 2 images --}}
              <div class="grid grid-cols-2 gap-2">
                @foreach(array_slice($images, 0, 2) as $index => $img)
                  <div class="aspect-[4/3] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $img) }}')">
                    <img src="{{ asset('storage/' . $img) }}" alt="Photo {{ $index + 1 }}" class="w-full h-full object-cover">
                  </div>
                @endforeach
              </div>
              {{-- Bottom row: 1 image full width --}}
              <div class="mt-2 aspect-[21/9] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $images[2]) }}')">
                <img src="{{ asset('storage/' . $images[2]) }}" alt="Photo 3" class="w-full h-full object-cover">
              </div>
            </div>
          @elseif($imageCount == 4)
            {{-- 4 images: 2x2 grid --}}
            <div class="grid grid-cols-2 gap-1 rounded-xl overflow-hidden border border-gray-200">
              @foreach($images as $index => $img)
                <div class="aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $img) }}')">
                  <img src="{{ asset('storage/' . $img) }}" alt="Photo {{ $index + 1 }}" class="w-full h-full object-cover">
                </div>
              @endforeach
            </div>
          @elseif($imageCount == 5)
            {{-- 5 images: 2 large on top + 3 smaller below (Facebook style) --}}
            <div class="rounded-xl overflow-hidden border border-gray-200">
              {{-- Top row: 2 images --}}
              <div class="grid grid-cols-2 gap-1">
                @foreach(array_slice($images, 0, 2) as $index => $img)
                  <div class="aspect-[4/3] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $img) }}')">
                    <img src="{{ asset('storage/' . $img) }}" alt="Photo {{ $index + 1 }}" class="w-full h-full object-cover">
                  </div>
                @endforeach
              </div>
              {{-- Bottom row: 3 images --}}
              <div class="grid grid-cols-3 gap-1 mt-1">
                @foreach(array_slice($images, 2, 3) as $index => $img)
                  <div class="aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $img) }}')">
                    <img src="{{ asset('storage/' . $img) }}" alt="Photo {{ $index + 3 }}" class="w-full h-full object-cover">
                  </div>
                @endforeach
              </div>
            </div>
          @else
            {{-- 6+ images: Show first 5 with +more indicator --}}
            <div class="rounded-xl overflow-hidden border border-gray-200">
              {{-- Top row: 2 images --}}
              <div class="grid grid-cols-2 gap-1">
                @foreach(array_slice($images, 0, 2) as $index => $img)
                  <div class="aspect-[4/3] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $img) }}')">
                    <img src="{{ asset('storage/' . $img) }}" alt="Photo {{ $index + 1 }}" class="w-full h-full object-cover">
                  </div>
                @endforeach
              </div>
              {{-- Bottom row: 3 images with +more overlay on last --}}
              <div class="grid grid-cols-3 gap-1 mt-1">
                @foreach(array_slice($images, 2, 3) as $index => $img)
                  <div class="relative aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('{{ asset('storage/' . $img) }}')">
                    <img src="{{ asset('storage/' . $img) }}" alt="Photo {{ $index + 3 }}" class="w-full h-full object-cover">
                    @if($index == 2 && $imageCount > 5)
                      <div class="absolute inset-0 bg-black/70 flex items-center justify-center">
                        <span class="text-white text-3xl font-bold">+{{ $imageCount - 5 }}</span>
                      </div>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endif
          
          <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Klik gambar untuk melihat ukuran penuh
          </p>

          {{-- Action Buttons (Like, Dislike & Comment) - Below Images --}}
          <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200">
            <div class="flex items-center gap-2">
              {{-- Like Button (Thumbs Up) - Green --}}
              <button onclick="likeThread({{ $thread->thread_id }}, this)" 
                class="like-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 {{ $thread->isLikedBy(auth()->user()) ? 'text-emerald-600' : 'text-gray-500' }}" 
                data-thread-id="{{ $thread->thread_id }}" 
                data-liked="{{ $thread->isLikedBy(auth()->user()) ? 'true' : 'false' }}">
                <svg class="w-5 h-5 {{ $thread->isLikedBy(auth()->user()) ? '' : 'group-hover:text-emerald-600' }}" fill="{{ $thread->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"></path>
                </svg>
                <span class="text-sm font-semibold likes-count">{{ number_format($thread->likes_count ?? 0) }}</span>
              </button>

              {{-- Dislike Button (Thumbs Down) - Gray when active --}}
              <button onclick="dislikeThread({{ $thread->thread_id }}, this)" 
                class="dislike-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 {{ $thread->isDislikedBy(auth()->user()) ? 'text-gray-600' : 'text-gray-500' }}"
                data-thread-id="{{ $thread->thread_id }}"
                data-disliked="{{ $thread->isDislikedBy(auth()->user()) ? 'true' : 'false' }}">
                <svg class="w-5 h-5 {{ $thread->isDislikedBy(auth()->user()) ? '' : 'group-hover:text-gray-600' }}" fill="{{ $thread->isDislikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zm7-13h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"></path>
                </svg>
                <span class="text-sm font-semibold dislikes-count">{{ number_format($thread->dislikes_count ?? 0) }}</span>
              </button>
            </div>

            {{-- Comment Button --}}
            <button onclick="document.getElementById('reply-section').scrollIntoView({ behavior: 'smooth' })" class="flex items-center gap-2 px-3 py-1.5 rounded-md text-gray-600 hover:bg-gray-100 transition-all duration-200">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
              </svg>
              <span class="text-sm font-semibold text-gray-700">{{ number_format($thread->replies_count ?? 0) }}</span>
              <span class="text-sm text-gray-500">Balasan</span>
            </button>
          </div>
        </div>
        @endif
      @else
        {{-- No images: Show action buttons after tags --}}
        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200">
          <div class="flex items-center gap-2">
            {{-- Like Button (Thumbs Up) - Green --}}
            <button onclick="likeThread({{ $thread->thread_id }}, this)" 
              class="like-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 {{ $thread->isLikedBy(auth()->user()) ? 'text-emerald-600' : 'text-gray-500' }}" 
              data-thread-id="{{ $thread->thread_id }}" 
              data-liked="{{ $thread->isLikedBy(auth()->user()) ? 'true' : 'false' }}">
              <svg class="w-5 h-5 {{ $thread->isLikedBy(auth()->user()) ? '' : 'group-hover:text-emerald-600' }}" fill="{{ $thread->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"></path>
              </svg>
              <span class="text-sm font-semibold likes-count">{{ number_format($thread->likes_count ?? 0) }}</span>
            </button>

            {{-- Dislike Button (Thumbs Down) - Gray when active --}}
            <button onclick="dislikeThread({{ $thread->thread_id }}, this)" 
              class="dislike-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 {{ $thread->isDislikedBy(auth()->user()) ? 'text-gray-600' : 'text-gray-500' }}"
              data-thread-id="{{ $thread->thread_id }}"
              data-disliked="{{ $thread->isDislikedBy(auth()->user()) ? 'true' : 'false' }}">
              <svg class="w-5 h-5 {{ $thread->isDislikedBy(auth()->user()) ? '' : 'group-hover:text-gray-600' }}" fill="{{ $thread->isDislikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zm7-13h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"></path>
              </svg>
              <span class="text-sm font-semibold dislikes-count">{{ number_format($thread->dislikes_count ?? 0) }}</span>
            </button>
          </div>

          {{-- Comment Button --}}
          <button onclick="document.getElementById('reply-section').scrollIntoView({ behavior: 'smooth' })" class="flex items-center gap-2 px-3 py-1.5 rounded-md text-gray-600 hover:bg-gray-100 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span class="text-sm font-semibold text-gray-700">{{ number_format($thread->replies_count ?? 0) }}</span>
            <span class="text-sm text-gray-500">Balasan</span>
          </button>
        </div>
      @endif
    </div>
  </div>

  {{-- Replies Section --}}
  <div id="reply-section" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
      <h2 class="text-lg font-bold text-gray-900">
        {{ number_format($thread->replies_count ?? 0) }} Balasan
      </h2>
    </div>

    <div class="p-6">
      {{-- Success Message --}}
      @if(session('success'))
        <div class="mb-6 p-3 rounded-lg bg-green-50 border border-green-200 flex items-center gap-3">
          <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span class="text-green-800 text-sm">{{ session('success') }}</span>
        </div>
      @endif

      {{-- Replies List --}}
      @if($thread->replies && $thread->replies->count() > 0)
        <div class="mb-8">
          <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            {{ $thread->replies->count() }} Balasan
          </h3>
          <div class="space-y-4">
            @foreach($thread->replies as $reply)
              @php
                $replyAuthor = $reply->author->name ?? 'User';
                // Check if reply author has uploaded avatar
                $hasReplyAvatar = $reply->author->profile && $reply->author->profile->avatar;
                if ($hasReplyAvatar) {
                  $replyAvatar = asset('storage/' . $reply->author->profile->avatar);
                } else {
                  $replyAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($replyAuthor) . '&color=ffffff&background=059669&size=40';
                }
              @endphp
              <div class="flex gap-3 pb-4 border-b border-gray-100 last:border-0 {{ $reply->is_solution ? 'bg-emerald-50/50 -mx-4 px-4 py-4 rounded-lg' : '' }}">
                <div class="shrink-0">
                  <img src="{{ $replyAvatar }}" alt="{{ $replyAuthor }}" class="w-10 h-10 rounded-full border-2 border-gray-100 object-cover">
                </div>
                <div class="flex-1">
                  <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center gap-2">
                      <span class="font-bold text-gray-900">{{ $replyAuthor }}</span>
                      <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                      @if($reply->is_solution)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-600 text-white text-xs font-bold rounded-md">
                          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                          Menjawab
                        </span>
                      @endif
                    </div>
                    
                    {{-- Toggle Solution Button (Only for Thread Owner) --}}
                    @auth
                      @if($thread->author_id == auth()->id())
                        <button onclick="toggleSolution({{ $reply->reply_id }}, {{ $reply->is_solution ? 'true' : 'false' }})" 
                          id="solution-btn-{{ $reply->reply_id }}"
                          class="text-xs font-semibold px-3 py-1.5 rounded-md transition flex items-center gap-1 {{ $reply->is_solution ? 'bg-emerald-600 text-white hover:bg-emerald-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                          <span class="solution-text">{{ $reply->is_solution ? 'Menjawab' : 'Tandai Menjawab' }}</span>
                        </button>
                      @endif
                    @endauth
                  </div>
                  <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $reply->content }}</p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      {{-- Reply Form --}}
      @auth
        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
          <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2 text-sm">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            Tulis Balasan
          </h3>
          <form action="{{ route('forum.reply', $thread->thread_id) }}" method="POST">
            @csrf
            <textarea 
              name="reply" 
              rows="3" 
              class="w-full px-3 py-2 text-sm border border-green-200 rounded-lg focus:outline-none focus:border-emerald-500 transition resize-none bg-white" 
              placeholder="Bagikan pendapat atau solusi Anda..."
              required
            ></textarea>
            @error('reply')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div class="flex justify-end mt-2">
              <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Kirim Balasan
              </button>
            </div>
          </form>
        </div>
      @else
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
          <svg class="w-10 h-10 text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
          <p class="text-gray-700 text-sm mb-3">Login untuk ikut berdiskusi</p>
          <a href="{{ route('show.login') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition font-semibold">
            Login Sekarang
          </a>
        </div>
      @endauth
    </div>
  </div>

</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all" onclick="event.stopPropagation()">
    <div class="text-center mb-6">
      <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
      </div>
      <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Thread?</h3>
      <p class="text-gray-600">Apakah Anda yakin ingin menghapus thread ini? Tindakan ini tidak dapat dibatalkan.</p>
    </div>
    
    <div class="flex gap-3">
      <button id="cancelDeleteBtn" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-semibold">
        Batal
      </button>
      <button id="confirmDeleteBtn" class="flex-1 px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-semibold">
        Hapus
      </button>
    </div>
  </div>
</div>

{{-- Image Modal --}}
<div id="imageModal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4" onclick="closeImageModal()">
  <div class="relative max-w-6xl max-h-[90vh]">
    <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
    <img id="modalImage" src="" alt="Full size" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl">
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium text-gray-700">
      Klik di luar untuk tutup
    </div>
  </div>
</div>

<script>
function openImageModal(imageSrc) {
  const modal = document.getElementById('imageModal');
  const modalImage = document.getElementById('modalImage');
  modalImage.src = imageSrc;
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  document.body.style.overflow = 'hidden';
}

function closeImageModal() {
  const modal = document.getElementById('imageModal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
  document.body.style.overflow = 'auto';
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeImageModal();
  }
});

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
      // Update the button that was clicked
      const svg = button.querySelector('svg');
      const countSpan = button.querySelector('.likes-count');
      
      if (data.liked) {
        // LIKED - Green filled icon
        svg.setAttribute('fill', 'currentColor');
        svg.setAttribute('stroke', 'currentColor');
        svg.style.color = '#10b981';
        button.style.color = '#10b981';
        countSpan.style.color = '#10b981';
      } else {
        // UNLIKED - Gray outline only
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.style.color = '#6b7280';
        button.style.color = '#6b7280';
        countSpan.style.color = '#6b7280';
      }
      
      // Update count
      countSpan.textContent = data.likes_count.toLocaleString();
      button.setAttribute('data-liked', data.liked ? 'true' : 'false');

      // Update dislike button if it exists
      const dislikeBtn = document.querySelector(`.dislike-btn[data-thread-id="${threadId}"]`);
      if (dislikeBtn) {
        const dislikeSvg = dislikeBtn.querySelector('svg');
        const dislikeCount = dislikeBtn.querySelector('.dislikes-count');
        
        // Reset to gray outline
        dislikeSvg.setAttribute('fill', 'none');
        dislikeSvg.setAttribute('stroke', 'currentColor');
        dislikeSvg.style.color = '#6b7280';
        dislikeBtn.style.color = '#6b7280';
        dislikeCount.style.color = '#6b7280';
        dislikeCount.textContent = data.dislikes_count.toLocaleString();
        dislikeBtn.setAttribute('data-disliked', 'false');
      }
    } else {
      alert(data.message || 'Gagal menyukai thread');
      if (response.status === 401) {
        window.location.href = '/login';
      }
    }
  } catch (error) {
    console.error('Error:', error);
    alert('Terjadi kesalahan');
  }
}

// Dislike thread function
async function dislikeThread(threadId, button) {
  try {
    const response = await fetch(`/forum/${threadId}/dislike`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    const data = await response.json();

    if (data.success) {
      // Update the button that was clicked
      const svg = button.querySelector('svg');
      const countSpan = button.querySelector('.dislikes-count');
      
      if (data.disliked) {
        // DISLIKED - Gray filled icon
        svg.setAttribute('fill', 'currentColor');
        svg.setAttribute('stroke', 'currentColor');
        svg.style.color = '#6b7280';
        button.style.color = '#6b7280';
        countSpan.style.color = '#6b7280';
      } else {
        // UN-DISLIKED - Gray outline only
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.style.color = '#6b7280';
        button.style.color = '#6b7280';
        countSpan.style.color = '#6b7280';
      }
      
      // Update count
      countSpan.textContent = data.dislikes_count.toLocaleString();
      button.setAttribute('data-disliked', data.disliked ? 'true' : 'false');

      // Update like button if it exists
      const likeBtn = document.querySelector(`.like-btn[data-thread-id="${threadId}"]`);
      if (likeBtn) {
        const likeSvg = likeBtn.querySelector('svg');
        const likeCount = likeBtn.querySelector('.likes-count');
        
        // Reset to gray outline
        likeSvg.setAttribute('fill', 'none');
        likeSvg.setAttribute('stroke', 'currentColor');
        likeSvg.style.color = '#6b7280';
        likeBtn.style.color = '#6b7280';
        likeCount.style.color = '#6b7280';
        likeCount.textContent = data.likes_count.toLocaleString();
        likeBtn.setAttribute('data-liked', 'false');
      }
    } else {
      alert(data.message || 'Gagal memberikan dislike');
      if (response.status === 401) {
        window.location.href = '/login';
      }
    }
  } catch (error) {
    console.error('Error:', error);
    alert('Terjadi kesalahan');
  }
}

// Toggle solved status
// Toggle reply as solution
async function toggleSolution(replyId, currentStatus) {
  try {
    const response = await fetch(`/forum/reply/${replyId}/toggle-solution`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    const data = await response.json();

    if (data.success) {
      showToast(data.message, 'success');
      // Reload page to show updated state
      setTimeout(() => {
        location.reload();
      }, 800);
    } else {
      showToast(data.message || 'Gagal mengubah status', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showToast('Terjadi kesalahan', 'error');
  }
}

// Toast notification function
function showToast(message, type = 'info') {
  // Create toast container if not exists
  let container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed top-6 right-6 z-50 space-y-2';
    document.body.appendChild(container);
  }
  
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
  
  toast.className = `flex items-center gap-3 ${colors[type]} text-white px-5 py-4 rounded-xl shadow-2xl min-w-[300px] animate-slideIn`;
  toast.innerHTML = `
    <span class="text-2xl">${icons[type]}</span>
    <span class="font-semibold">${message}</span>
  `;
  
  container.appendChild(toast);
  
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(400px)';
    toast.style.transition = 'all 0.3s ease-out';
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// Confirm delete function
async function confirmDelete(threadId) {
  const modal = document.getElementById('deleteModal');
  const confirmBtn = document.getElementById('confirmDeleteBtn');
  const cancelBtn = document.getElementById('cancelDeleteBtn');
  
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  document.body.style.overflow = 'hidden';
  
  // Remove previous event listeners
  const newConfirmBtn = confirmBtn.cloneNode(true);
  confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
  
  const newCancelBtn = cancelBtn.cloneNode(true);
  cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);
  
  // Add new event listener for confirm
  document.getElementById('confirmDeleteBtn').addEventListener('click', async function() {
    try {
      const response = await fetch(`/forum/${threadId}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });

      const data = await response.json();

      if (data.success) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        
        showToast('Thread berhasil dihapus', 'success');
        
        setTimeout(() => {
          window.location.href = '/forum';
        }, 1000);
      } else {
        showToast(data.message || 'Gagal menghapus thread', 'error');
      }
    } catch (error) {
      console.error('Error:', error);
      showToast('Terjadi kesalahan', 'error');
    }
  });
  
  // Add event listener for cancel
  document.getElementById('cancelDeleteBtn').addEventListener('click', function() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
  });
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('deleteModal');
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
      }
    });
  }
});


</script>

</x-layout>