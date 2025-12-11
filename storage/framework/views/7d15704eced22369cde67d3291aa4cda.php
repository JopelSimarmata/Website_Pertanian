<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $attributes = $__attributesOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__attributesOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $component = $__componentOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__componentOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>


<div class="bg-green-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    <div class="text-center">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Forum Diskusi</h1>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">Punya pertanyaan tentang pertanian? Tanya di sini, kami siap membantu!</p>
    </div>

    
    <form method="GET" action="<?php echo e(route('forum.index')); ?>" class="mt-8 max-w-2xl mx-auto">
      <div class="relative bg-gray-50 rounded-xl border-2 border-gray-200 focus-within:border-emerald-500 transition">
        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
        </svg>
        <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Contoh: Cara mengatasi hama wereng, pupuk terbaik untuk padi..." 
          class="w-full pl-12 pr-24 py-4 border-0 focus:ring-0 text-gray-900 placeholder-gray-500 bg-transparent" />
        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
          Cari
        </button>
      </div>
    </form>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  
  <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center gap-2 mb-4">
      <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
      </svg>
      <h2 class="text-lg font-semibold text-gray-900">Kategori Diskusi</h2>
    </div>
    
    <form method="GET" action="<?php echo e(route('forum.index')); ?>">
      
      <?php if(request('search')): ?>
        <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
      <?php endif; ?>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <div>
          <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
            Pilih Kategori
          </label>
          <select id="category" name="category" onchange="this.form.submit()" class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($cat->category_id); ?>" <?php echo e(request('category') == $cat->category_id ? 'selected' : ''); ?>>
                <?php echo e($cat->name); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
            Status Diskusi
          </label>
          <select id="status" name="status" onchange="this.form.submit()" class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            <option value="">Semua Status</option>
            <option value="solved" <?php echo e(request('status') == 'solved' ? 'selected' : ''); ?>>Sudah Terjawab</option>
            <option value="unsolved" <?php echo e(request('status') == 'unsolved' ? 'selected' : ''); ?>>Belum Terjawab</option>
          </select>
        </div>
      </div>
    </form>
  </div>

  
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    
    <div class="lg:col-span-2">

  
  <?php if(request('search')): ?>
    <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 flex items-center gap-3">
      <svg class="w-6 h-6 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      <div>
        <p class="text-sm text-blue-900">
          Hasil pencarian untuk: <span class="font-bold">"<?php echo e(request('search')); ?>"</span>
        </p>
        <p class="text-xs text-blue-700 mt-0.5">Ditemukan <?php echo e($threads->total()); ?> diskusi</p>
      </div>
    </div>
  <?php endif; ?>

  
  <?php if($threads->isEmpty()): ?>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
      <div class="w-20 h-20 overflow-hidden flex items-center justify-center mx-auto mb-6">
        <img src="<?php echo e(asset('icons/icons8-thinking-80.png')); ?>" 
             class="w-20 h-20 object-cover">
      </div>
      <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Diskusi</h3>
      <p class="text-gray-600 mb-8 max-w-md mx-auto">
        <?php if(request('search')): ?>
          Tidak ditemukan diskusi dengan kata kunci tersebut. Coba kata kunci lain atau buat diskusi baru!
        <?php else: ?>
          Jadilah yang pertama memulai diskusi di kategori ini!
        <?php endif; ?>
      </p>
      <a href="<?php echo e(route('forum.add')); ?>" class="inline-flex items-center gap-2 px-8 py-4 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-semibold text-lg shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Mulai Diskusi Baru
      </a>
    </div>
  <?php else: ?>
    <div class="space-y-4">
      <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-gray-300 transition-colors overflow-hidden relative cursor-pointer" onclick="window.location='<?php echo e(route('forum.detail', $thread->thread_id)); ?>'">
          
          
          <div class="absolute top-4 right-4 z-10 mt-2" onclick="event.stopPropagation()">
            <?php if($thread->is_solved): ?>
              <span class="inline-flex items-center px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                Sudah Terjawab
              </span>
            <?php else: ?>
              <span class="inline-flex items-center px-3 py-1.5 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold">
                Belum Terjawab
              </span>
            <?php endif; ?>
          </div>

          <div class="p-6 pt-14">
            <div class="flex gap-4">
              
              
              <div class="shrink-0">
                <?php
                  $authorName = $thread->author->name ?? 'User';
                  // Check if user has uploaded avatar
                  $hasAvatar = $thread->author->profile && $thread->author->profile->avatar;
                  if ($hasAvatar) {
                    $avatar = asset('storage/' . $thread->author->profile->avatar);
                  } else {
                    $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&color=ffffff&background=059669&size=56';
                  }
                ?>
                <img src="<?php echo e($avatar); ?>" alt="<?php echo e($authorName); ?>" class="w-14 h-14 rounded-full border-2 border-emerald-100 shadow-sm object-cover">
              </div>

              
              <div class="flex-1 min-w-0">
                
                
                <?php if($thread->is_pinned || $thread->category): ?>
                  <div class="flex flex-wrap items-center gap-2 mb-2">
                    <?php if($thread->is_pinned): ?>
                      <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-bold">
                        📌 Penting
                      </span>
                    <?php endif; ?>
                    <?php if($thread->category): ?>
                      <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold">
                        <?php echo e($thread->category->name); ?>

                      </span>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
                
                
                <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-emerald-600 transition line-clamp-2">
                  <?php echo e($thread->title); ?>

                </h3>
                
                
                <p class="text-gray-600 mb-3 line-clamp-2"><?php echo e(Str::limit(strip_tags($thread->content), 180)); ?></p>

                
                <?php if($thread->tags && is_array($thread->tags) && count($thread->tags) > 0): ?>
                  <div class="flex flex-wrap gap-1.5 mb-3">
                    <?php $__currentLoopData = $thread->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <span class="inline-flex items-center px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-xs">
                        #<?php echo e($tag); ?>

                      </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                <?php endif; ?>

                
                <?php if($thread->image): ?>
                  <?php
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
                  ?>
                  
                  <?php if($imageCount > 0): ?>
                    <div class="mb-4 w-full">
                      <?php if($imageCount == 1): ?>
                        
                        <div class="rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          <div class="w-full bg-gray-50" style="max-height: 350px;">
                            <img src="<?php echo e(asset('storage/' . $images[0])); ?>" alt="Preview" class="w-full h-full object-cover">
                          </div>
                        </div>
                      <?php elseif($imageCount == 2): ?>
                        
                        <div class="grid grid-cols-2 gap-2 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-50" style="height: 250px;">
                              <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Preview" class="w-full h-full object-cover">
                            </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      <?php elseif($imageCount == 3): ?>
                        
                        <div class="rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          
                          <div class="grid grid-cols-2 gap-2">
                            <?php $__currentLoopData = array_slice($images, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="bg-gray-50" style="height: 180px;">
                                <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Preview" class="w-full h-full object-cover">
                              </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                          
                          <div class="mt-2 bg-gray-50" style="height: 140px;">
                            <img src="<?php echo e(asset('storage/' . $images[2])); ?>" alt="Preview" class="w-full h-full object-cover">
                          </div>
                        </div>
                      <?php elseif($imageCount == 4): ?>
                        
                        <div class="grid grid-cols-2 gap-2 rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-50" style="height: 200px;">
                              <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Preview" class="w-full h-full object-cover">
                            </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      <?php else: ?>
                        
                        <div class="rounded-xl overflow-hidden border border-gray-200 hover:border-emerald-300 transition-all shadow-sm hover:shadow-md">
                          
                          <div class="grid grid-cols-2 gap-2">
                            <?php $__currentLoopData = array_slice($images, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="bg-gray-50" style="height: 180px;">
                                <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Preview" class="w-full h-full object-cover">
                              </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                          
                          <div class="grid grid-cols-3 gap-2 mt-2">
                            <?php $__currentLoopData = array_slice($images, 2, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="relative bg-gray-50" style="height: 120px;">
                                <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Preview" class="w-full h-full object-cover">
                                <?php if($index == 2 && $imageCount > 5): ?>
                                  <div class="absolute inset-0 bg-black/70 flex items-center justify-center backdrop-blur-sm">
                                    <span class="text-white text-xl font-bold">+<?php echo e($imageCount - 5); ?></span>
                                  </div>
                                <?php endif; ?>
                              </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>

                
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium text-gray-700"><?php echo e($authorName); ?></span>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span><?php echo e($thread->created_at->diffForHumans()); ?></span>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span><?php echo e(number_format($thread->views_count ?? 0)); ?></span>
                  </div>
                </div>

                
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200">
                  <div class="flex items-center gap-2">
                    
                    <button onclick="event.stopPropagation(); likeThread(<?php echo e($thread->thread_id); ?>, this)" 
                      class="like-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 <?php echo e($thread->isLikedBy(auth()->user()) ? 'text-emerald-600' : 'text-gray-500'); ?>" 
                      data-thread-id="<?php echo e($thread->thread_id); ?>" 
                      data-liked="<?php echo e($thread->isLikedBy(auth()->user()) ? 'true' : 'false'); ?>">
                      <svg class="w-5 h-5 <?php echo e($thread->isLikedBy(auth()->user()) ? '' : 'group-hover:text-emerald-600'); ?>" fill="<?php echo e($thread->isLikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"></path>
                      </svg>
                      <span class="text-sm font-semibold likes-count"><?php echo e(number_format($thread->likes_count ?? 0)); ?></span>
                    </button>

                    
                    <button onclick="event.stopPropagation(); dislikeThread(<?php echo e($thread->thread_id); ?>, this)" 
                      class="dislike-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 <?php echo e($thread->isDislikedBy(auth()->user()) ? 'text-gray-600' : 'text-gray-500'); ?>"
                      data-thread-id="<?php echo e($thread->thread_id); ?>"
                      data-disliked="<?php echo e($thread->isDislikedBy(auth()->user()) ? 'true' : 'false'); ?>">
                      <svg class="w-5 h-5 <?php echo e($thread->isDislikedBy(auth()->user()) ? '' : 'group-hover:text-gray-600'); ?>" fill="<?php echo e($thread->isDislikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zm7-13h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"></path>
                      </svg>
                      <span class="text-sm font-semibold dislikes-count"><?php echo e(number_format($thread->dislikes_count ?? 0)); ?></span>
                    </button>
                  </div>

                  
                  <button onclick="event.stopPropagation();" class="flex items-center gap-2 px-3 py-1.5 rounded-md text-gray-600 hover:bg-gray-100 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="text-sm font-semibold text-gray-700"><?php echo e(number_format($thread->replies_count ?? 0)); ?></span>
                    <span class="text-sm text-gray-500">Balasan</span>
                  </button>
                </div>
              </div>

            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="mt-8">
      <?php echo e($threads->links()); ?>

    </div>
  <?php endif; ?>
    </div>

    
    <div class="lg:col-span-1 space-y-6">
      
      
      <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl shadow-md border-2 border-emerald-300 overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-500 to-green-500 px-5 py-4">
          <div class="flex items-center">
            <h3 class="font-bold text-white text-lg flex items-center gap-2">
              <span class="text-2xl">🏆</span>
              Thread Teraktif
            </h3>
          </div>
        </div>

        <?php
          // Popular threads berdasarkan kombinasi likes, replies, dan views
          $popularThreads = \App\Models\ForumThread::with(['author.profile', 'category', 'likes'])
            ->withCount('replies')
            ->orderByRaw('(likes_count * 3 + replies_count * 2 + COALESCE(views_count, 0)) DESC')
            ->take(5)
            ->get();
        ?>

        <div class="p-4 space-y-2">
          <?php $__currentLoopData = $popularThreads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('forum.detail', $popular->thread_id)); ?>" class="flex items-center gap-3 p-3 bg-white rounded-lg hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 transition group border border-transparent hover:border-emerald-200">
              
              <div class="shrink-0">
                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow-sm
                  <?php echo e($index === 0 ? 'bg-gradient-to-br from-emerald-400 to-emerald-600 text-white' : ''); ?>

                  <?php echo e($index === 1 ? 'bg-gradient-to-br from-green-400 to-green-600 text-white' : ''); ?>

                  <?php echo e($index === 2 ? 'bg-gradient-to-br from-teal-400 to-teal-600 text-white' : ''); ?>

                  <?php echo e($index > 2 ? 'bg-gray-100 text-gray-600' : ''); ?>">
                  <?php echo e($index + 1); ?>

                </div>
              </div>
              
              
              <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-sm text-gray-900 group-hover:text-emerald-700 transition line-clamp-1 mb-1">
                  <?php echo e($popular->title); ?>

                </h4>
                
                
                <div class="flex items-center gap-2 text-xs text-gray-500">
                  
                  <?php
                    $popAuthorName = $popular->author->name ?? 'User';
                    $hasPopAvatar = $popular->author->profile && $popular->author->profile->avatar;
                    if ($hasPopAvatar) {
                      $popAvatar = asset('storage/' . $popular->author->profile->avatar);
                    } else {
                      $popAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($popAuthorName) . '&color=ffffff&background=059669&size=20';
                    }
                  ?>
                  <img src="<?php echo e($popAvatar); ?>" alt="<?php echo e($popAuthorName); ?>" class="w-4 h-4 rounded-full border border-emerald-100 object-cover">
                  
                  
                  <span class="flex items-center gap-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="font-medium text-emerald-600"><?php echo e(number_format($popular->replies_count)); ?></span>
                  </span>
                  <span class="text-gray-300">•</span>
                  
                  
                  <span class="flex items-center gap-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <?php echo e(number_format($popular->views_count ?? 0)); ?>

                  </span>
                </div>
              </div>

              
              <svg class="w-4 h-4 text-gray-300 group-hover:text-emerald-600 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center gap-2">
          <span class="text-xl">🔥</span>
          Topik Populer
        </h3>
        <div class="space-y-3">
          <a href="<?php echo e(route('forum.index', ['sort' => 'popular'])); ?>" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-emerald-50 transition group">
            <span class="text-sm font-medium text-  -700 group-hover:text-emerald-700">Hama Wereng Padi</span>
            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
          <a href="<?php echo e(route('forum.index', ['sort' => 'popular'])); ?>" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-emerald-50 transition group">
            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-700">Pupuk Organik</span>
            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
          <a href="<?php echo e(route('forum.index', ['sort' => 'popular'])); ?>" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-emerald-50 transition group">
            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-700">Perawatan Tanaman</span>
            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>

      
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


<a href="<?php echo e(route('forum.add')); ?>" class="fixed bottom-6 right-6 z-50 inline-flex items-center gap-2 px-6 py-4 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition font-bold text-lg shadow-lg">
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
        button.classList.add('text-emerald-600');
        button.classList.remove('text-gray-500');
        heartIcon.setAttribute('fill', 'currentColor');
        heartIcon.classList.add('fill-current');
        button.setAttribute('data-liked', 'true');
      } else {
        button.classList.remove('text-emerald-600');
        button.classList.add('text-gray-500');
        heartIcon.setAttribute('fill', 'none');
        heartIcon.classList.remove('fill-current');
        button.setAttribute('data-liked', 'false');
      }
      
      // Update all like buttons for this thread on the page
      document.querySelectorAll(`.like-btn[data-thread-id="${threadId}"]`).forEach(btn => {
        const count = btn.querySelector('.likes-count');
        const icon = btn.querySelector('svg');
        if (count) count.textContent = data.likes_count.toLocaleString();
        if (icon) {
          if (data.liked) {
            btn.classList.add('text-emerald-600');
            btn.classList.remove('text-gray-500');
            icon.setAttribute('fill', 'currentColor');
            icon.classList.add('fill-current');
          } else {
            btn.classList.remove('text-emerald-600');
            btn.classList.add('text-gray-500');
            icon.setAttribute('fill', 'none');
            icon.classList.remove('fill-current');
          }
        }
        btn.setAttribute('data-liked', data.liked ? 'true' : 'false');
      });

      // Update all dislike buttons for this thread
      document.querySelectorAll(`.dislike-btn[data-thread-id="${threadId}"]`).forEach(btn => {
        const count = btn.querySelector('.dislikes-count');
        if (count) count.textContent = data.dislikes_count.toLocaleString();
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
      const dislikesCountEl = button.querySelector('.dislikes-count');
      const icon = button.querySelector('svg');
      
      // Update counter
      dislikesCountEl.textContent = data.dislikes_count.toLocaleString();
      
      // Update button state
      if (data.disliked) {
        button.classList.add('text-gray-600');
        button.classList.remove('text-gray-500');
        icon.setAttribute('fill', 'currentColor');
        icon.classList.add('fill-current');
        button.setAttribute('data-disliked', 'true');
      } else {
        button.classList.remove('text-gray-600');
        button.classList.add('text-gray-500');
        icon.setAttribute('fill', 'none');
        icon.classList.remove('fill-current');
        button.setAttribute('data-disliked', 'false');
      }
      
      // Update all dislike buttons for this thread on the page
      document.querySelectorAll(`.dislike-btn[data-thread-id="${threadId}"]`).forEach(btn => {
        const count = btn.querySelector('.dislikes-count');
        const icon = btn.querySelector('svg');
        if (count) count.textContent = data.dislikes_count.toLocaleString();
        if (icon) {
          if (data.disliked) {
            btn.classList.add('text-gray-600');
            btn.classList.remove('text-gray-500');
            icon.setAttribute('fill', 'currentColor');
            icon.classList.add('fill-current');
          } else {
            btn.classList.remove('text-gray-600');
            btn.classList.add('text-gray-500');
            icon.setAttribute('fill', 'none');
            icon.classList.remove('fill-current');
          }
        }
        btn.setAttribute('data-disliked', data.disliked ? 'true' : 'false');
      });

      // Update all like buttons for this thread
      document.querySelectorAll(`.like-btn[data-thread-id="${threadId}"]`).forEach(btn => {
        const count = btn.querySelector('.likes-count');
        if (count) count.textContent = data.likes_count.toLocaleString();
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\Users\asus3\Downloads\projext papwe\Website_Pertanian\resources\views/forum/index.blade.php ENDPATH**/ ?>