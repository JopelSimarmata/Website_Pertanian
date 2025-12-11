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
  <div class="min-h-screen bg-gradient-to-r from-green-100 to-green-20">
    <div class="max-w-7xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <!-- Left: welcome, image, stats -->
        <div class="space-y-8">
          <div class="flex items-center gap-3">
            <div class="rounded-xl overflow-hidden">
              <!-- small logo (fill the rounded box and let the shadow wrap the image) -->
              <a href="/">
                <img src="<?php echo e(asset('image/logo.png')); ?>" alt="LadangQu" class="h-15 w-15 object-cover block"> 
              </a>
            </div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-emerald-800">LadangQu</h1>
          </div>
  
          <div>
            <h2 class="text-3xl lg:text-4xl font-bold text-emerald-900 leading-tight">Selamat Datang di Platform Pertanian Indonesia</h2>
            <p class="mt-3 text-emerald-700 max-w-xl">Bergabunglah dengan ribuan petani di seluruh Indonesia untuk berbagi pengalaman, berdiskusi, dan berbelanja kebutuhan pertanian.</p>
          </div>

          
          <div class="mt-4">
              <div class="rounded-2xl overflow-hidden shadow-lg shrink-0">
              <img src="<?php echo e(asset('image/field.jpg')); ?>" alt="field" class="w-full h-64 object-cover">
            </div>
          </div>

          <div class="flex gap-4 mt-6">
            <div class="bg-white rounded-xl shadow p-4 w-1/3 text-center">
              <div class="text-2xl font-bold text-emerald-700">10K+</div>
              <div class="text-sm text-gray-500">Petani</div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 w-1/3 text-center">
              <div class="text-2xl font-bold text-emerald-700">5K+</div>
              <div class="text-sm text-gray-500">Produk</div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 w-1/3 text-center">
              <div class="text-2xl font-bold text-emerald-700">50K+</div>
              <div class="text-sm text-gray-500">Diskusi</div>
            </div>
          </div>
        </div>

        <!-- Right: login card -->
        <div class="flex items-center justify-center">
          <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 ring-1 ring-gray-100">
            <h3 class="text-center text-lg font-semibold text-emerald-800">Masuk ke Akun Anda</h3>
            <p class="text-center text-sm text-gray-500 mt-2">Masukkan email dan password untuk melanjutkan</p>

            
            <?php if($errors->any()): ?>
              <div class="mt-4 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                <div class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <div class="flex-1">
                    <h3 class="font-semibold text-red-800 text-sm mb-1">Terjadi Kesalahan</h3>
                    <ul class="text-sm text-red-700 space-y-1">
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
              <div class="mt-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg p-4">
                <div class="flex items-center gap-3">
                  <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <p class="text-emerald-800 font-medium text-sm"><?php echo e(session('success')); ?></p>
                </div>
              </div>
            <?php endif; ?>

            <form action="<?php echo e(route('login')); ?>" method="POST" class="mt-6 space-y-4">
              <?php echo csrf_field(); ?>

              <button type="button" class="w-full flex items-center justify-center gap-3 border border-gray-200 rounded-md px-4 py-2 text-sm hover:bg-gray-50">
                <!-- Google icon -->
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21.6 10.23h-9.6v3.54h5.52c-.24 1.5-1.68 4.41-5.52 4.41-3.33 0-6.03-2.73-6.03-6.09S8.19 6 11.52 6c1.86 0 3.12.78 3.84 1.44l2.64-2.56C16.44 3.18 14.28 2 11.52 2 6.63 2 2.76 5.94 2.76 11s3.87 9 8.76 9c5.04 0 8.4-3.54 8.4-8.55 0-.57-.06-1.02-.12-1.22z" fill="#EA4335"/>
                </svg>
                <span class="text-sm text-gray-700">Masuk dengan Google</span>
              </button>

              <div class="flex items-center gap-3">
                <div class="flex-1 h-px bg-gray-200"></div>
                <div class="text-xs text-gray-400 uppercase">atau</div>
                <div class="flex-1 h-px bg-gray-200"></div>
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                  id="email" 
                  name="email" 
                  type="email" 
                  value="<?php echo e(old('email')); ?>" 
                  required 
                  autocomplete="email" 
                  class="mt-2 block w-full rounded-md border <?php echo e($errors->has('email') ? 'border-red-500 focus:ring-red-300' : 'border-gray-200 focus:ring-emerald-300'); ?> px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2" 
                />
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div>
                <div class="flex items-center justify-between">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <a href="#" class="text-sm text-emerald-600 hover:underline">Lupa password?</a>
                </div>
                <div class="mt-2 relative">
                  <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    required 
                    autocomplete="current-password" 
                    class="block w-full rounded-md border <?php echo e($errors->has('password') ? 'border-red-500 focus:ring-red-300' : 'border-gray-200 focus:ring-emerald-300'); ?> px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2" 
                  />
                  <button type="button" id="togglePwd" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.27 2.943 9.542 7-1.273 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </button>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div>
                <button type="submit" class="w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">Masuk</button>
              </div>
            </form>

            <p class="mt-4 text-center text-sm text-gray-500">Belum punya akun? <a href="/register" class="text-emerald-600 font-semibold hover:underline">Daftar sekarang</a></p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- small script to toggle password visibility -->
  <script>
    (function(){
      const pwd = document.getElementById('password');
      const btn = document.getElementById('togglePwd');
      if(!pwd || !btn) return;
      btn.addEventListener('click', function(){
        if(pwd.type === 'password'){ pwd.type = 'text'; } else { pwd.type = 'password'; }
      });
    })();
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
<?php endif; ?><?php /**PATH C:\Users\asus3\Downloads\projext papwe\Website_Pertanian\resources\views/auth/login.blade.php ENDPATH**/ ?>