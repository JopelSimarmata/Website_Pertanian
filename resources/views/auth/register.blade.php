<x-layout>
  <div class="min-h-screen bg-gradient-to-r from-green-100 to-green-20">
    <div class="max-w-7xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <!-- Left: welcome, image, stats -->
        <div class="space-y-8">
          <div class="flex items-center gap-3">
            <div class="rounded-xl overflow-hidden">
              <a href="/">
                <img src="{{ asset('image/logo.png') }}" alt="LadangQu" class="h-15 w-15 object-cover block"> 
              </a>
            </div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-emerald-800">LadangQu</h1>
          </div>

          <div>
            <h2 class="text-3xl lg:text-4xl font-bold text-emerald-900 leading-tight">Penghubung Petani & Tengkulak Indonesia</h2>
            <p class="mt-3 text-emerald-700 max-w-xl">Daftar sekarang dan bergabung dengan komunitas kami — tawarkan hasil panen atau temukan produk pertanian berkualitas.</p>
          </div>

          <div class="mt-4">
            <div class="rounded-2xl overflow-hidden shadow-lg">
              <img src="{{ asset('image/produce.jpg') }}" alt="produce" class="w-full h-64 object-cover">
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

        <!-- Right: register card -->
        <div class="flex items-center justify-center">
          <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 ring-1 ring-gray-100">
            <h3 class="text-center text-lg font-semibold text-emerald-800">Buat Akun Baru</h3>
            <p class="text-center text-sm text-gray-500 mt-2">Daftar sekarang dan bergabung dengan komunitas kami</p>

            {{-- Error Messages --}}
            @if ($errors->any())
              <div class="mt-4 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                <div class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <div class="flex-1">
                    <h3 class="font-semibold text-red-800 text-sm mb-1">Terjadi Kesalahan</h3>
                    <ul class="text-sm text-red-700 space-y-1">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-4">
              @csrf

                <a href="{{ route('google.redirect') }}" 
                  class="w-full flex items-center justify-center border border-gray-200 rounded-md px-4 py-2 text-sm hover:bg-gray-50">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                      <path d="M21.6 10.23h-9.6v3.54h5.52c-.24 1.5-1.68 4.41-5.52 4.41-3.33 0-6.03-2.73-6.03-6.09S8.19 6 11.52 6c1.86 0 3.12.78 3.84 1.44l2.64-2.56C16.44 3.18 14.28 2 11.52 2 6.63 2 2.76 5.94 2.76 11s3.87 9 8.76 9c5.04 0 8.4-3.54 8.4-8.55 0-.57-.06-1.02-.12-1.22z" fill="#EA4335"/>
                    </svg>
                    <span class="text-sm text-gray-700">Daftar dengan Google</span>
                </a>

              <div class="flex items-center gap-3">
                <div class="flex-1 h-px bg-gray-200"></div>
                <div class="text-xs text-gray-400 uppercase">atau</div>
                <div class="flex-1 h-px bg-gray-200"></div>
              </div>

              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input 
                  id="name" 
                  name="name" 
                  type="text" 
                  value="{{ old('name') }}" 
                  required 
                  class="mt-2 block w-full rounded-md border {{ $errors->has('name') ? 'border-red-500 focus:ring-red-300' : 'border-gray-200 focus:ring-emerald-300' }} px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2" 
                />
                @error('name')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                  id="email" 
                  name="email" 
                  type="email" 
                  value="{{ old('email') }}" 
                  required 
                  class="mt-2 block w-full rounded-md border {{ $errors->has('email') ? 'border-red-500 focus:ring-red-300' : 'border-gray-200 focus:ring-emerald-300' }} px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2" 
                />
                @error('email')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>


              <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password </label>
                <div class="mt-2 relative">
                  <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    required 
                    class="block w-full rounded-md border {{ $errors->has('password') ? 'border-red-500 focus:ring-red-300' : 'border-gray-200 focus:ring-emerald-300' }} px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2" 
                  />
                  <button type="button" id="togglePwd" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.27 2.943 9.542 7-1.273 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </button>
                </div>
                @error('password')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <div class="mt-2 relative">
                  <input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    required 
                    class="block w-full rounded-md border {{ $errors->has('password_confirmation') ? 'border-red-500 focus:ring-red-300' : 'border-gray-200 focus:ring-emerald-300' }} px-3 py-2 placeholder-gray-400 focus:outline-none focus:ring-2" 
                  />
                  <button type="button" id="toggleConfirm" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.27 2.943 9.542 7-1.273 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </button>
                </div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Sebagai</label>
                <div class="flex gap-4">
                  <label class="flex items-center gap-3 bg-white border border-gray-200 rounded-lg p-3 w-1/2 cursor-pointer">
                    <input type="radio" name="role" value="tengkulak" checked class="h-4 w-4 text-emerald-600" />
                    <div>
                      <div class="text-sm font-semibold text-gray-700">Tengkulak</div>
                      <div class="text-xs text-gray-400">Mencari produk pertanian dari petani</div>
                    </div>
                  </label>

                  <label class="flex items-center gap-3 bg-white border border-gray-200 rounded-lg p-3 w-1/2 cursor-pointer">
                    <input type="radio" name="role" value="petani" class="h-4 w-4 text-emerald-600" />
                    <div>
                      <div class="text-sm font-semibold text-gray-700">Petani</div>
                      <div class="text-xs text-gray-400">Menawarkan produk pertanian</div>
                    </div>
                  </label>
                </div>
              </div>

              <div>
                <button type="submit" class="w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">Daftar</button>
              </div>
            </form>

            <p class="mt-4 text-center text-sm text-gray-500">Sudah punya akun? <a href="/login" class="text-emerald-600 font-semibold hover:underline">Masuk sekarang</a></p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    (function(){
      const pwd = document.getElementById('password');
      const btn = document.getElementById('togglePwd');
      const conf = document.getElementById('password_confirmation');
      const btnConf = document.getElementById('toggleConfirm');

      if(btn && pwd){
        btn.addEventListener('click', () => {
          pwd.type = pwd.type === 'password' ? 'text' : 'password';
        });
      }
      if(btnConf && conf){
        btnConf.addEventListener('click', () => {
          conf.type = conf.type === 'password' ? 'text' : 'password';
        });
      }
    })();
  </script>
</x-layout>