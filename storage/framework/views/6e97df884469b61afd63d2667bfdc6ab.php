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

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  
  <div class="mb-6">
    <a href="<?php echo e(route('forum.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-white border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-emerald-300 transition font-medium">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Kembali ke Forum</span>
    </a>
  </div>

  
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    
    
    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-100">
      <div class="flex items-start justify-between gap-4 mb-3">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-2">
            <?php if($thread->is_pinned): ?>
              <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-semibold">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path>
                </svg>
                Thread Dipinned
              </span>
            <?php endif; ?>
            
            <?php if($thread->is_solved): ?>
              <span class="thread-status-badge inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Terjawab
              </span>
            <?php else: ?>
              <span class="thread-status-badge inline-flex items-center gap-1 px-2.5 py-1 bg-rose-100 text-rose-700 rounded-lg text-xs font-semibold">
                Belum Terjawab
              </span>
            <?php endif; ?>
            
            <?php if($thread->category): ?>
              <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold">
                <?php echo e($thread->category->name); ?>

              </span>
            <?php endif; ?>
          </div>

          <h1 class="text-2xl font-bold text-gray-900 mb-2"><?php echo e($thread->title); ?></h1>

          <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <?php
                $authorName = $thread->author->name ?? 'User';
                // Check if user has uploaded avatar
                $hasAvatar = $thread->author->profile && $thread->author->profile->avatar;
                if ($hasAvatar) {
                  $avatar = asset('storage/' . $thread->author->profile->avatar);
                } else {
                  $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&color=ffffff&background=059669&size=32';
                }
              ?>
              <img src="<?php echo e($avatar); ?>" alt="<?php echo e($authorName); ?>" class="w-8 h-8 rounded-full border-2 border-emerald-100 object-cover">
              <span class="font-semibold text-gray-900"><?php echo e($authorName); ?></span>
            </div>
            <div class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <span><?php echo e($thread->created_at->diffForHumans()); ?></span>
            </div>
            <div class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
              <span><?php echo e(number_format($thread->views_count ?? 0)); ?></span>
            </div>
          </div>
        </div>

        
        <div class="flex flex-col gap-2">
          <?php if(auth()->guard()->check()): ?>
            
            <?php if(auth()->id() === $thread->author_id): ?>
              <button onclick="toggleSolved(<?php echo e($thread->thread_id); ?>)" id="toggleSolvedBtn" 
                class="w-full px-4 py-2 rounded-lg font-semibold transition flex items-center justify-center gap-2 text-sm
                <?php echo e($thread->is_solved ? 'bg-gray-100 text-gray-700 hover:bg-gray-200' : 'bg-emerald-500 text-white hover:bg-emerald-600'); ?>"
                data-solved="<?php echo e($thread->is_solved ? 'true' : 'false'); ?>">
                <svg class="w-4 h-4 btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <?php if($thread->is_solved): ?>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  <?php else: ?>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  <?php endif; ?>
                </svg>
                <span class="btn-text"><?php echo e($thread->is_solved ? 'Batal Terjawab' : 'Tandai Terjawab'); ?></span>
              </button>
            <?php endif; ?>

            
            <?php if(auth()->id() === $thread->author_id || auth()->user()->role === 'admin'): ?>
              <div class="flex gap-1.5 justify-center">
                <a href="<?php echo e(route('forum.edit', $thread->thread_id)); ?>" class="p-2 text-gray-500 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                </a>
                <button onclick="confirmDelete(<?php echo e($thread->thread_id); ?>)" class="p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    
    <div class="px-6 pt-3 pb-2">
      <div class="prose max-w-none text-gray-700 leading-relaxed">
        <?php echo nl2br(e($thread->content)); ?>

      </div>

      
      <?php if($thread->tags): ?>
        <?php
          $threadTags = is_array($thread->tags) ? $thread->tags : json_decode($thread->tags, true);
        ?>
        <?php if($threadTags && is_array($threadTags) && count($threadTags) > 0): ?>
          <div class="flex flex-wrap gap-2 mt-1 pt-1 border-t border-gray-100">
            <span class="text-sm text-gray-500 font-medium">Tags:</span>
            <?php $__currentLoopData = $threadTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <span class="inline-flex items-center px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium">
                #<?php echo e($tag); ?>

              </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      
      <?php if($thread->image): ?>
        <?php
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
        ?>
        
        <?php if($imageCount > 0): ?>
        
        <div class="mt-6 pt-6 border-t border-gray-100">
          <div class="flex items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-sm font-semibold text-gray-700"><?php echo e($imageCount); ?> Foto</span>
          </div>
          
          
          <?php if($imageCount == 1): ?>
            
            <div class="rounded-xl overflow-hidden border border-gray-200 cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $images[0])); ?>')">
              <img src="<?php echo e(asset('storage/' . $images[0])); ?>" alt="Photo 1" class="w-full h-auto max-h-[500px] object-cover">
            </div>
          <?php elseif($imageCount == 2): ?>
            
            <div class="grid grid-cols-2 gap-1 rounded-xl overflow-hidden border border-gray-200">
              <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $img)); ?>')">
                  <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Photo <?php echo e($index + 1); ?>" class="w-full h-full object-cover">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php elseif($imageCount == 3): ?>
            
            <div class="rounded-xl overflow-hidden border border-gray-200">
              
              <div class="grid grid-cols-2 gap-2">
                <?php $__currentLoopData = array_slice($images, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="aspect-[4/3] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $img)); ?>')">
                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Photo <?php echo e($index + 1); ?>" class="w-full h-full object-cover">
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              
              <div class="mt-2 aspect-[21/9] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $images[2])); ?>')">
                <img src="<?php echo e(asset('storage/' . $images[2])); ?>" alt="Photo 3" class="w-full h-full object-cover">
              </div>
            </div>
          <?php elseif($imageCount == 4): ?>
            
            <div class="grid grid-cols-2 gap-1 rounded-xl overflow-hidden border border-gray-200">
              <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $img)); ?>')">
                  <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Photo <?php echo e($index + 1); ?>" class="w-full h-full object-cover">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php elseif($imageCount == 5): ?>
            
            <div class="rounded-xl overflow-hidden border border-gray-200">
              
              <div class="grid grid-cols-2 gap-1">
                <?php $__currentLoopData = array_slice($images, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="aspect-[4/3] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $img)); ?>')">
                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Photo <?php echo e($index + 1); ?>" class="w-full h-full object-cover">
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              
              <div class="grid grid-cols-3 gap-1 mt-1">
                <?php $__currentLoopData = array_slice($images, 2, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $img)); ?>')">
                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Photo <?php echo e($index + 3); ?>" class="w-full h-full object-cover">
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          <?php else: ?>
            
            <div class="rounded-xl overflow-hidden border border-gray-200">
              
              <div class="grid grid-cols-2 gap-1">
                <?php $__currentLoopData = array_slice($images, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="aspect-[4/3] cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $img)); ?>')">
                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Photo <?php echo e($index + 1); ?>" class="w-full h-full object-cover">
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              
              <div class="grid grid-cols-3 gap-1 mt-1">
                <?php $__currentLoopData = array_slice($images, 2, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="relative aspect-square cursor-pointer hover:opacity-95 transition" onclick="openImageModal('<?php echo e(asset('storage/' . $img)); ?>')">
                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Photo <?php echo e($index + 3); ?>" class="w-full h-full object-cover">
                    <?php if($index == 2 && $imageCount > 5): ?>
                      <div class="absolute inset-0 bg-black/70 flex items-center justify-center">
                        <span class="text-white text-3xl font-bold">+<?php echo e($imageCount - 5); ?></span>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          <?php endif; ?>
          
          <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Klik gambar untuk melihat ukuran penuh
          </p>

          
          <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200">
            <div class="flex items-center gap-2">
              
              <button onclick="likeThread(<?php echo e($thread->thread_id); ?>, this)" 
                class="like-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 <?php echo e($thread->isLikedBy(auth()->user()) ? 'text-emerald-600' : 'text-gray-500'); ?>" 
                data-thread-id="<?php echo e($thread->thread_id); ?>" 
                data-liked="<?php echo e($thread->isLikedBy(auth()->user()) ? 'true' : 'false'); ?>">
                <svg class="w-5 h-5 <?php echo e($thread->isLikedBy(auth()->user()) ? '' : 'group-hover:text-emerald-600'); ?>" fill="<?php echo e($thread->isLikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"></path>
                </svg>
                <span class="text-sm font-semibold likes-count"><?php echo e(number_format($thread->likes_count ?? 0)); ?></span>
              </button>

              
              <button onclick="dislikeThread(<?php echo e($thread->thread_id); ?>, this)" 
                class="dislike-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 <?php echo e($thread->isDislikedBy(auth()->user()) ? 'text-gray-600' : 'text-gray-500'); ?>"
                data-thread-id="<?php echo e($thread->thread_id); ?>"
                data-disliked="<?php echo e($thread->isDislikedBy(auth()->user()) ? 'true' : 'false'); ?>">
                <svg class="w-5 h-5 <?php echo e($thread->isDislikedBy(auth()->user()) ? '' : 'group-hover:text-gray-600'); ?>" fill="<?php echo e($thread->isDislikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zm7-13h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"></path>
                </svg>
                <span class="text-sm font-semibold dislikes-count"><?php echo e(number_format($thread->dislikes_count ?? 0)); ?></span>
              </button>
            </div>

            
            <button onclick="document.getElementById('reply-section').scrollIntoView({ behavior: 'smooth' })" class="flex items-center gap-2 px-3 py-1.5 rounded-md text-gray-600 hover:bg-gray-100 transition-all duration-200">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
              </svg>
              <span class="text-sm font-semibold text-gray-700"><?php echo e(number_format($thread->replies_count ?? 0)); ?></span>
              <span class="text-sm text-gray-500">Balasan</span>
            </button>
          </div>
        </div>
        <?php endif; ?>
      <?php else: ?>
        
        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200">
          <div class="flex items-center gap-2">
            
            <button onclick="likeThread(<?php echo e($thread->thread_id); ?>, this)" 
              class="like-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 <?php echo e($thread->isLikedBy(auth()->user()) ? 'text-emerald-600' : 'text-gray-500'); ?>" 
              data-thread-id="<?php echo e($thread->thread_id); ?>" 
              data-liked="<?php echo e($thread->isLikedBy(auth()->user()) ? 'true' : 'false'); ?>">
              <svg class="w-5 h-5 <?php echo e($thread->isLikedBy(auth()->user()) ? '' : 'group-hover:text-emerald-600'); ?>" fill="<?php echo e($thread->isLikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"></path>
              </svg>
              <span class="text-sm font-semibold likes-count"><?php echo e(number_format($thread->likes_count ?? 0)); ?></span>
            </button>

            
            <button onclick="dislikeThread(<?php echo e($thread->thread_id); ?>, this)" 
              class="dislike-btn group flex items-center gap-1.5 px-3 py-1.5 rounded-md transition-all duration-200 <?php echo e($thread->isDislikedBy(auth()->user()) ? 'text-gray-600' : 'text-gray-500'); ?>"
              data-thread-id="<?php echo e($thread->thread_id); ?>"
              data-disliked="<?php echo e($thread->isDislikedBy(auth()->user()) ? 'true' : 'false'); ?>">
              <svg class="w-5 h-5 <?php echo e($thread->isDislikedBy(auth()->user()) ? '' : 'group-hover:text-gray-600'); ?>" fill="<?php echo e($thread->isDislikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zm7-13h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"></path>
              </svg>
              <span class="text-sm font-semibold dislikes-count"><?php echo e(number_format($thread->dislikes_count ?? 0)); ?></span>
            </button>
          </div>

          
          <button onclick="document.getElementById('reply-section').scrollIntoView({ behavior: 'smooth' })" class="flex items-center gap-2 px-3 py-1.5 rounded-md text-gray-600 hover:bg-gray-100 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span class="text-sm font-semibold text-gray-700"><?php echo e(number_format($thread->replies_count ?? 0)); ?></span>
            <span class="text-sm text-gray-500">Balasan</span>
          </button>
        </div>
      <?php endif; ?>
    </div>
  </div>

  
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
      <h2 class="text-lg font-bold text-gray-900">
        <?php echo e(number_format($thread->replies_count ?? 0)); ?> Balasan
      </h2>
    </div>

    <div class="p-6">
      
      <?php if(session('success')): ?>
        <div class="mb-6 p-3 rounded-lg bg-green-50 border border-green-200 flex items-center gap-3">
          <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span class="text-green-800 text-sm"><?php echo e(session('success')); ?></span>
        </div>
      <?php endif; ?>

      
      <?php if($thread->replies && $thread->replies->count() > 0): ?>
        <div class="mb-8">
          <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <?php echo e($thread->replies->count()); ?> Balasan
          </h3>
          <div class="space-y-4">
            <?php $__currentLoopData = $thread->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $replyAuthor = $reply->author->name ?? 'User';
                // Check if reply author has uploaded avatar
                $hasReplyAvatar = $reply->author->profile && $reply->author->profile->avatar;
                if ($hasReplyAvatar) {
                  $replyAvatar = asset('storage/' . $reply->author->profile->avatar);
                } else {
                  $replyAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($replyAuthor) . '&color=ffffff&background=059669&size=40';
                }
              ?>
              <div class="flex gap-3 pb-4 border-b border-gray-100 last:border-0">
                <div class="shrink-0">
                  <img src="<?php echo e($replyAvatar); ?>" alt="<?php echo e($replyAuthor); ?>" class="w-10 h-10 rounded-full border-2 border-gray-100 object-cover">
                </div>
                <div class="flex-1">
                  <div class="flex items-center gap-2 mb-1">
                    <span class="font-bold text-gray-900"><?php echo e($replyAuthor); ?></span>
                    <span class="text-xs text-gray-500"><?php echo e($reply->created_at->diffForHumans()); ?></span>
                  </div>
                  <p class="text-gray-700 leading-relaxed whitespace-pre-line"><?php echo e($reply->content); ?></p>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      <?php endif; ?>

      
      <?php if(auth()->guard()->check()): ?>
        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
          <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2 text-sm">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            Tulis Balasan
          </h3>
          <form action="<?php echo e(route('forum.reply', $thread->thread_id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <textarea 
              name="reply" 
              rows="3" 
              class="w-full px-3 py-2 text-sm border border-green-200 rounded-lg focus:outline-none focus:border-emerald-500 transition resize-none bg-white" 
              placeholder="Bagikan pendapat atau solusi Anda..."
              required
            ></textarea>
            <?php $__errorArgs = ['reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
      <?php else: ?>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
          <svg class="w-10 h-10 text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
          <p class="text-gray-700 text-sm mb-3">Login untuk ikut berdiskusi</p>
          <a href="<?php echo e(route('show.login')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition font-semibold">
            Login Sekarang
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>

</div>


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
      const likesCountEl = button.querySelector('.likes-count');
      const heartIcon = button.querySelector('svg');
      
      likesCountEl.textContent = data.likes_count.toLocaleString();
      
      if (data.liked) {
        button.classList.add('text-emerald-600');
        button.classList.remove('text-gray-600');
        heartIcon.setAttribute('fill', 'currentColor');
        button.setAttribute('data-liked', 'true');
      } else {
        button.classList.remove('text-emerald-600');
        button.classList.add('text-gray-600');
        heartIcon.setAttribute('fill', 'none');
        button.setAttribute('data-liked', 'false');
      }

      // Update dislikes count
      const dislikeButtons = document.querySelectorAll(`.dislike-btn[data-thread-id="${threadId}"]`);
      dislikeButtons.forEach(btn => {
        const count = btn.querySelector('.dislikes-count');
        if (count) count.textContent = data.dislikes_count.toLocaleString();
      });
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
      const dislikesCountEl = button.querySelector('.dislikes-count');
      const icon = button.querySelector('svg');
      
      dislikesCountEl.textContent = data.dislikes_count.toLocaleString();
      
      if (data.disliked) {
        button.classList.add('text-gray-600');
        button.classList.remove('text-gray-500');
        icon.setAttribute('fill', 'currentColor');
        button.setAttribute('data-disliked', 'true');
      } else {
        button.classList.remove('text-gray-600');
        button.classList.add('text-gray-500');
        icon.setAttribute('fill', 'none');
        button.setAttribute('data-disliked', 'false');
      }

      // Update likes count
      const likeButtons = document.querySelectorAll(`.like-btn[data-thread-id="${threadId}"]`);
      likeButtons.forEach(btn => {
        const count = btn.querySelector('.likes-count');
        if (count) count.textContent = data.likes_count.toLocaleString();
      });
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
async function toggleSolved(threadId) {
  const button = document.getElementById('toggleSolvedBtn');
  const currentSolved = button.getAttribute('data-solved') === 'true';
  
  try {
    const response = await fetch(`/forum/${threadId}/toggle-solved`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    const data = await response.json();

    if (data.success) {
      // Show toast notification
      showToast(data.message, data.is_solved ? 'success' : 'info');
      
      // Reload page after short delay to sync with main list
      setTimeout(() => {
        window.location.reload();
      }, 1000);
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\Users\asus3\Downloads\projext papwe\Website_Pertanian\resources\views/forum/detail.blade.php ENDPATH**/ ?>