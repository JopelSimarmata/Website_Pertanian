<x-layout>

<x-navbar></x-navbar>

  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-emerald-800">Marketplace Pertanian</h1>
      <p class="text-gray-600 mt-2">Belanja produk pertanian berkualitas langsung dari petani dengan sistem pembayaran aman</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center mb-8">
      <div class="md:col-span-2">
        <div class="relative bg-white rounded-lg shadow-sm p-2">
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
          <input type="text" placeholder="Cari produk pertanian..." class="w-full pl-10 px-4 py-3 rounded-md border border-green-100 focus:outline-none" />
        </div>
      </div>

      <div class="flex gap-3 justify-end">
        <button class="inline-flex items-center gap-2 border rounded-md px-3 py-2 bg-white">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h2a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM13 4h6M13 12h6M13 8h6M13 16h6"/></svg>
          <span class="text-sm text-gray-700">Semua Hasil Panen</span>
        </button>
      </div>
    </div>

    @if(session('success'))
      <div class="mb-4 rounded-md bg-green-50 p-3 text-green-800">{{ session('success') }}</div>
    @endif

    @if(empty($products) || (is_countable($products) && count($products) === 0))
      <div class="rounded-md border border-dashed border-gray-200 p-8 text-center text-gray-500">
        Belum ada produk di marketplace.
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
          <article class="bg-white rounded-2xl shadow p-4 flex flex-col relative">
            <div class="relative rounded-md overflow-hidden">
              <img src="{{ $product->image_url ?? asset('image/placeholder.png') }}" alt="{{ $product->title }}" class="w-full h-40 object-cover" />
              @if(isset($product->available) && $product->available)
                <div class="absolute left-3 top-3 bg-emerald-600 text-white text-xs px-2 py-1 rounded">Tersedia</div>
              @endif
              @guest
                <button aria-label="Tambahkan ke favorit" class="absolute right-3 top-3 bg-white rounded-full w-9 h-9 flex items-center justify-center shadow require-login" title="Tambahkan ke favorit (silakan masuk terlebih dahulu)">
                  <!-- outline heart for guests -->
                  <svg class="w-5 h-5 text-rose-500" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.172 7.172a4.5 4.5 0 016.364 0L12 9.636l2.464-2.464a4.5 4.5 0 116.364 6.364L12 21.364l-8.828-8.828a4.5 4.5 0 010-6.364z" />
                  </svg>
                </button>
              @else
                <button aria-label="Hapus dari favorit" class="absolute right-3 top-3 bg-white rounded-full w-9 h-9 flex items-center justify-center shadow hover:bg-rose-50 js-toggle-favorite" data-product-id="{{ $product->id }}">
                  <!-- filled heart for logged-in users -->
                  <svg class="w-5 h-5 text-rose-500" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.001 4.529c1.688-2.02 5.063-2.02 6.752 0 1.67 2.00 1.58 5.145-.223 7.082L12 21.35l-6.53-9.739c-1.803-1.937-1.893-5.082-.223-7.082 1.689-2.02 5.064-2.02 6.754 0z"/>
                  </svg>
                </button>
              @endguest
            </div>

            <div class="mt-4 flex-1">
              <a href="/marketplace/{{ $product->id }}" class="text-base font-semibold text-emerald-800 hover:underline">{{ $product->title }}</a>
              <div class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 90) }}</div>
            </div>

            <div class="mt-4 text-sm text-gray-600 flex items-center gap-3">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.839-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/></svg>
                <span class="text-sm text-gray-700">{{ $product->rating ?? '-' }} ({{ $product->reviews_count ?? 0 }})</span>
              </div>
              <div class="text-xs text-gray-400">•</div>
              <div class="text-sm text-gray-600">{{ $product->location ?? '' }}</div>
            </div>

            <div class="mt-4">
              <div class="bg-emerald-50 border border-emerald-200 rounded px-3 py-3">
                <div class="text-xs text-gray-500">Harga Petani</div>
                <div class="font-semibold text-lg text-emerald-700">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }} <span class="text-sm text-gray-600">/{{ $product->unit ?? 'kg' }}</span></div>
                <div class="text-xs text-gray-400">Total Hasil Panen: {{ $product->total_hasil_panen ?? 'N/A' }}</div>
              </div>
            </div>

            <div class="mt-4">
              @guest
                <a href="#" class="block w-full text-center bg-emerald-600 text-white rounded px-4 py-2 require-login">Lihat Detail & Tinjau Lokasi</a>
              @else
                <a href="/marketplace/{{ $product->id }}" class="block w-full text-center bg-emerald-600 text-white rounded px-4 py-2">Lihat Detail & Tinjau Lokasi</a>
              @endguest
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </div>
  
  <!-- Footer-like info section at the very end of marketplace page -->
  <footer class="mt-12 bg-gradient-to-b from-[#071428] via-[#0b2740] to-[#101a2b] text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-lg">LQ</div>
          <div>
            <div class="text-emerald-400 font-semibold text-lg">LadangQu</div>
            <div class="text-sm text-gray-400 mt-1">Platform forum dan marketplace pertanian terpadu untuk Indonesia</div>
          </div>
        </div>

        <div>
          <div class="font-semibold text-gray-200 mb-3">Forum</div>
          <ul class="text-sm text-gray-400 space-y-2">
            <li class="hover:text-white">Diskusi Umum</li>
            <li class="hover:text-white">Tips & Trik</li>
            <li class="hover:text-white">Hama & Penyakit</li>
          </ul>
        </div>

        <div>
          <div class="font-semibold text-gray-200 mb-3">Platform</div>
          <ul class="text-sm text-gray-400 space-y-2">
            <li class="hover:text-white">Untuk Petani</li>
            <li class="hover:text-white">Untuk Tengkulak</li>
            <li class="hover:text-white">Cara Kerja</li>
          </ul>
        </div>

        <div>
          <div class="font-semibold text-gray-200 mb-3">Kontak</div>
          <div class="text-sm text-gray-400">Email: info@LadangQu.com</div>
          <div class="text-sm text-gray-400 mt-1">Telp: (021) 1234-5678</div>
        </div>
      </div>

      <div class="mt-8 border-t border-gray-700 pt-6 text-center text-sm text-gray-500">
        © 2025 LadangQu. All rights reserved.
      </div>
    </div>
  </footer>
  
  {{-- include login prompt modal for guest CTA --}}
  @include('marketplace._login_prompt_modal')
</x-layout>
