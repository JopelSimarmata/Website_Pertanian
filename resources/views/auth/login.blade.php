<x-layout>
  <div class="min-h-screen bg-gradient-to-r from-green-100 to-green-20">
    <div class="max-w-7xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <!-- Left: welcome, image, stats -->
        <div class="space-y-8">
          <div class="flex items-center gap-3">
            <div class="rounded-xl overflow-hidden">
              <!-- small logo (fill the rounded box and let the shadow wrap the image) -->
              <a href="/">
                <img src="{{ asset('image/logo.png') }}" alt="LadangQu" class="h-15 w-15 object-cover block"> 
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
              <img src="{{ asset('image/field.jpg') }}" alt="field" class="w-full h-64 object-cover">
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

            <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-4">
              @csrf

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
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="mt-2 block w-full rounded-md border border-gray-200 px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-300" />
              </div>

              <div>
                <div class="flex items-center justify-between">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <a href="#" class="text-sm text-emerald-600 hover:underline">Lupa password?</a>
                </div>
                <div class="mt-2 relative">
                  <input id="password" name="password" type="password" required autocomplete="current-password" class="block w-full rounded-md border border-gray-200 px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-300" />
                  <button type="button" id="togglePwd" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.27 2.943 9.542 7-1.273 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </button>
                </div>
              </div>

              <div>
                <button type="submit" class="w-full rounded-md bg-green-500 hover:bg-green-600 text-white py-2 font-semibold">Masuk</button>
              </div>
            </form>

            <p class="mt-4 text-center text-sm text-gray-500">Belum punya akun? <a href="/register" class="text-emerald-600 font-semibold hover:underline">Daftar sekarang</a></p>
          </div>
        </div>

      </div>
    </div>
      @if ($errors->any())
      <div class="mt-4">
        <ul class="list-disc list-inside text-sm text-red-600">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </form>



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
</x-layout>