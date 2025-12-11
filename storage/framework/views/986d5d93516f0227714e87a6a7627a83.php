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
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Marketplace Pertanian</h1>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">Temukan berbagai produk pertanian berkualitas langsung dari petani lokal untuk mendukung kebutuhan Anda.</p>
    </div>

    
    <form method="GET" action="<?php echo e(route('marketplace')); ?>" class="mt-8 max-w-2xl mx-auto">
      <div class="relative bg-gray-50 rounded-xl border-2 border-gray-200 focus-within:border-emerald-500 transition">
        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
        </svg>
        <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari produk, kategori, atau penjual..." 
          class="w-full pl-12 pr-24 py-4 border-0 focus:ring-0 text-gray-900 placeholder-gray-500 bg-transparent" />
        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
          Cari
        </button>
      </div>
    </form>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
  
  <?php if(session('success')): ?>
    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-center gap-3">
      <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span class="text-green-800"><?php echo e(session('success')); ?></span>
    </div>
  <?php endif; ?>

  
  <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center gap-2 mb-4">
      <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
      </svg>
      <h2 class="text-lg font-semibold text-gray-900">Filter & Urutkan</h2>
    </div>
    
    <form method="GET" action="<?php echo e(route('marketplace')); ?>">
      
      <?php if(request('q')): ?>
        <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
      <?php endif; ?>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        
        <div>
          <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
            <svg class="w-4 h-4 inline mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            Kategori
          </label>
          <select id="category" name="category" class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            <option value="all">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($cat->category_id); ?>" <?php echo e((string)request('category') === (string)$cat->category_id ? 'selected' : ''); ?>>
                <?php echo e(ucfirst(str_replace('-', ' ', $cat->slug))); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        
        <div>
          <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">
            <svg class="w-4 h-4 inline mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
            </svg>
            Urutkan
          </label>
          <select id="sort" name="sort" class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
            <option value="">Terbaru</option>
            <option value="price_asc" <?php echo e(request('sort') == 'price_asc' ? 'selected' : ''); ?>>Harga Terendah</option>
            <option value="price_desc" <?php echo e(request('sort') == 'price_desc' ? 'selected' : ''); ?>>Harga Tertinggi</option>
            <option value="rating" <?php echo e(request('sort') == 'rating' ? 'selected' : ''); ?>>Rating Tertinggi</option>
          </select>
        </div>

        
        <div>
          <label for="min_price" class="block text-sm font-medium text-gray-700 mb-2">
            <svg class="w-4 h-4 inline mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Harga Minimum
          </label>
          <input type="number" id="min_price" name="min_price" placeholder="Rp 0" value="<?php echo e(request('min_price')); ?>" 
            class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" />
        </div>

        
        <div>
          <label for="max_price" class="block text-sm font-medium text-gray-700 mb-2">
            <svg class="w-4 h-4 inline mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Harga Maximum
          </label>
          <input type="number" id="max_price" name="max_price" placeholder="Tidak terbatas" value="<?php echo e(request('max_price')); ?>" 
            class="w-full rounded-xl border-2 border-gray-300 py-2.5 px-4 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" />
        </div>
      </div>

      
      <div class="flex flex-col sm:flex-row gap-3">
        <button type="submit" class="flex-1 sm:flex-initial inline-flex items-center justify-center px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-500 transition font-medium text-sm shadow-sm hover:shadow-md">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          Terapkan Filter
        </button>
        
        <?php if(request()->hasAny(['q', 'category', 'min_price', 'max_price', 'sort'])): ?>
          <a href="<?php echo e(route('marketplace')); ?>" class="flex-1 sm:flex-initial inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-medium text-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Reset Filter
          </a>
        <?php endif; ?>
      </div>

      
      <?php if(request()->hasAny(['category', 'min_price', 'max_price', 'sort'])): ?>
        <div class="mt-4 pt-4 border-t border-gray-200">
          <div class="flex flex-wrap gap-2 items-center">
            <span class="text-sm text-gray-500 font-medium">Filter aktif:</span>
            <?php if(request('category') && request('category') !== 'all'): ?>
              <?php
                $selectedCat = $categories->firstWhere('category_id', request('category'));
              ?>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                <?php echo e(ucfirst(str_replace('-', ' ', $selectedCat->slug ?? 'Kategori'))); ?>

              </span>
            <?php endif; ?>
            <?php if(request('min_price')): ?>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                Min: Rp <?php echo e(number_format(request('min_price'), 0, ',', '.')); ?>

              </span>
            <?php endif; ?>
            <?php if(request('max_price')): ?>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                Max: Rp <?php echo e(number_format(request('max_price'), 0, ',', '.')); ?>

              </span>
            <?php endif; ?>
            <?php if(request('sort')): ?>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                <?php echo e(request('sort') == 'price_asc' ? 'Harga Terendah' : (request('sort') == 'price_desc' ? 'Harga Tertinggi' : 'Rating Tertinggi')); ?>

              </span>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </form>
  </div>

  
  <div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-600">
      Menampilkan <span class="font-semibold text-gray-900"><?php echo e($products->count()); ?></span> dari 
      <span class="font-semibold text-gray-900"><?php echo e($products->total()); ?></span> produk
      <?php if(request('q')): ?>
        untuk "<span class="font-semibold text-emerald-600"><?php echo e(request('q')); ?></span>"
      <?php endif; ?>
    </p>
  </div>

  
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <?php
        $thumb = optional($product->images->first())->path ?? $product->image_url ?? null;
        $thumbUrl = $thumb ? (preg_match('/^https?:\/\//', $thumb) ? $thumb : asset(ltrim($thumb, '/'))) : 'https://images.unsplash.com/photo-1560493676-04071c5f467b?w=400&h=300&fit=crop';
      ?>
      <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
        
        <div class="relative aspect-[4/3] overflow-hidden">
          <img src="<?php echo e($thumbUrl); ?>" alt="<?php echo e($product->name); ?>" 
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
          
          
          <div class="absolute top-3 left-3">
            <?php if($product->stock > 0): ?>
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500 text-white shadow-sm">
                <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
                Tersedia
              </span>
            <?php else: ?>
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-500 text-white shadow-sm">
                Habis
              </span>
            <?php endif; ?>
          </div>

          
          <?php if($product->category): ?>
            <div class="absolute top-3 right-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-white/90 text-gray-700 shadow-sm backdrop-blur-sm">
                <?php echo e(ucfirst(str_replace('-', ' ', $product->category->slug))); ?>

              </span>
            </div>
          <?php endif; ?>

          
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
            <a href="<?php echo e(route('marketplace.detail', $product->product_id)); ?>" 
              class="px-4 py-2 bg-white text-emerald-700 rounded-lg font-medium text-sm shadow-lg hover:bg-emerald-50 transition transform translate-y-4 group-hover:translate-y-0 duration-300">
              Lihat Detail
            </a>
          </div>
        </div>

        
        <div class="p-4">
          
          <h3 class="font-semibold text-gray-900 truncate group-hover:text-emerald-700 transition">
            <?php echo e($product->name); ?>

          </h3>

          
          <div class="mt-2 flex items-center gap-2">
            <div class="flex items-center">
              <?php for($i = 1; $i <= 5; $i++): ?>
                <svg class="w-4 h-4 <?php echo e($i <= ($product->rating ?? 4) ? 'text-yellow-400' : 'text-gray-200'); ?>" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/>
                </svg>
              <?php endfor; ?>
            </div>
            <span class="text-sm text-gray-500">(<?php echo e($product->reviews_count ?? 0); ?>)</span>
          </div>

          
          <div class="mt-2 flex items-center text-sm text-gray-500">
            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="truncate"><?php echo e($product->location ?? 'Lokasi tidak tersedia'); ?></span>
          </div>

          
          <div class="mt-2 flex items-center text-sm text-gray-500">
            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="truncate"><?php echo e($product->seller->name ?? 'Petani'); ?></span>
          </div>

          
          <div class="mt-4 p-3 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-100">
            <div class="flex items-baseline justify-between">
              <div>
                <span class="text-xs text-emerald-600 font-medium">Harga</span>
                <div class="text-xl font-bold text-emerald-700">
                  Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                  <span class="text-sm font-normal text-emerald-600">/ <?php echo e($product->unit ?? 'kg'); ?></span>
                </div>
              </div>
              <div class="text-right">
                <span class="text-xs text-gray-500">Stok</span>
                <div class="text-sm font-semibold text-gray-700"><?php echo e(number_format($product->stock ?? 0, 0, ',', '.')); ?> <?php echo e($product->unit ?? 'kg'); ?></div>
              </div>
            </div>
          </div>

          
          <a href="<?php echo e(route('marketplace.detail', $product->product_id)); ?>" 
            class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl font-medium text-sm hover:bg-emerald-500 transition shadow-sm hover:shadow group">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Lihat Detail
          </a>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      
      <div class="col-span-full">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
          <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Produk tidak ditemukan</h3>
          <p class="text-gray-500 mb-6">Coba ubah filter pencarian Anda atau jelajahi kategori lain.</p>
          <a href="<?php echo e(route('marketplace')); ?>" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Reset Filter
          </a>
        </div>
      </div>
    <?php endif; ?>
  </div>

  
  <?php if($products->hasPages()): ?>
    <div class="mt-8">
      <?php echo e($products->links()); ?>

    </div>
  <?php endif; ?>
</div>


<?php if(auth()->guard()->check()): ?>
  <?php if((auth()->user()->role ?? '') === 'petani'): ?>
    <div class="bg-emerald-50 border-t border-emerald-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
          <div>
            <h3 class="text-lg font-semibold text-emerald-800">Ingin menjual produk Anda?</h3>
            <p class="text-emerald-600">Tambahkan produk ke marketplace dan jangkau lebih banyak pembeli.</p>
          </div>
          <a href="<?php echo e(route('dashboard.farmer.product.create')); ?>" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-500 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
          </a>
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\Users\asus3\Downloads\projext papwe\Website_Pertanian\resources\views/marketplace/index.blade.php ENDPATH**/ ?>