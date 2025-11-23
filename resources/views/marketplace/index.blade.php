<x-layout>
<x-navbar></x-navbar>
<div class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold text-emerald-800">Marketplace Pertanian</h2>
    <p>Temukan berbagai produk pertanian berkualitas untuk mendukung kebutuhan Anda.</p>

    <!-- Search & Filters -->
    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div class="w-full sm:max-w-xl">
        <label for="search" class="sr-only">Cari produk</label>
        <div class="relative">
          <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
          <input id="search" type="search" placeholder="Cari produk, kategori, atau penjual..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" />
        </div>
      </div>

      <div class="flex items-center gap-3">
        <label for="category" class="sr-only">Kategori</label>
        <select id="category" class="rounded-lg border border-gray-200 py-2 px-3 text-sm text-gray-700 bg-white">
          <option>Semua Kategori</option>
          <option>Pupuk</option>
          <option>Bibit</option>
          <option>Alat</option>
          <option>Hasil Panen</option>
        </select>

        <button class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Harga</button>
        <button class="px-3 py-2 bg-emerald-600 text-white rounded-lg text-sm hover:bg-emerald-500">Filter</button>
      </div>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-9">
      <!-- Card 1 -->
      <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
        <div class="relative">
          <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tomat" class="w-full h-48 object-cover rounded-t-2xl" />
          <span class="absolute left-3 top-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Tersedia</span>
          <button class="absolute right-3 top-3 bg-white/90 border border-gray-200 rounded-full p-2 shadow-sm flex items-center justify-center">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 10-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
          </button>
        </div>
        <div class="p-6 flex flex-col justify-between flex-1">
          <div>
            <h3 class="text-lg font-semibold text-gray-800 truncate">Tomat Merah Segar Grade A</h3>
            <p class="mt-2 text-sm text-gray-500">Tomat merah segar kualitas grade A langsung dari kebun. Cocok untuk konsumsi dan pasar.</p>

            <div class="mt-4 flex items-center text-sm text-gray-600 gap-4">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/></svg>
                <span class="text-sm">4.8</span>
                <span class="text-gray-400">(187)</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/></svg>
                <span class="text-gray-600 ">Laguboti, Sumatera Utara</span>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-3 text-emerald-800 text-sm min-h-[72px]">
              <div class="font-semibold">Harga Petani</div>
              <div class="text-lg font-bold mt-1">Rp 7.000/ kg</div>
              <div class="text-xs text-emerald-700 mt-1">Total Hasil Panen: 2.000 kg</div>
            </div>

            <div class="mt-3 text-xs text-gray-500">Penjual: Petani Tomat Makmur</div>

            <div class="mt-4">
              
              <a href="/marketplace/1" class="inline-flex items-center justify-center w-full px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-500 text-sm">Lihat Detail & Tinjau Lokasi</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
        <div class="relative">
          <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/category-page-04-image-card-02.jpg" alt="Kubis" class="w-full h-48 object-cover rounded-t-2xl" />
          <span class="absolute left-3 top-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Tersedia</span>
          <button class="absolute right-3 top-3 bg-white/90 border border-gray-200 rounded-full p-2 shadow-sm flex items-center justify-center">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 10-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
          </button>
        </div>
        <div class="p-6 flex flex-col justify-between flex-1">
          <div>
            <h3 class="text-lg font-semibold text-gray-800 truncate">Kubis/Kol Segar Premium</h3>
            <p class="mt-2 text-sm text-gray-500">Kubis segar premium hasil panen dataran tinggi. Kualitas terbaik untuk pasar.</p>

            <div class="mt-4 flex items-center text-sm text-gray-600 gap-4">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/></svg>
                <span class="text-sm">4.9</span>
                <span class="text-gray-400">(234)</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/></svg>
                <span class="text-gray-600">Balige, Sumatera Utara</span>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-3 text-emerald-800 text-sm min-h-[72px]">
              <div class="font-semibold">Harga Petani</div>
              <div class="text-lg font-bold mt-1">Rp 4.500/ kg</div>
              <div class="text-xs text-emerald-700 mt-1">Total Hasil Panen: 5.000 kg</div>
            </div>

            <div class="mt-3 text-xs text-gray-500">Penjual: Kebun Sayur Lembang</div>

            <div class="mt-4">
              <a href="#" class="inline-flex items-center justify-center w-full px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-500 text-sm">Lihat Detail & Tinjau Lokasi</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
        <div class="relative">
          <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/category-page-04-image-card-03.jpg" alt="Jagung" class="w-full h-48 object-cover rounded-t-2xl" />
          <span class="absolute left-3 top-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Tersedia</span>
          <button class="absolute right-3 top-3 bg-white/90 border border-gray-200 rounded-full p-2 shadow-sm flex items-center justify-center">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 10-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
          </button>
        </div>
        <div class="p-6 flex flex-col justify-between flex-1">
          <div>
            <h3 class="text-lg font-semibold text-gray-800 truncate">Jagung Manis Pipilan Grade A</h3>
            <p class="mt-2 text-sm text-gray-500">Jagung manis pipilan segar kualitas A untuk pasar grosir. Rasa manis.</p>

            <div class="mt-4 flex items-center text-sm text-gray-600 gap-4">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/></svg>
                <span class="text-sm">4.7</span>
                <span class="text-gray-400">(156)</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/></svg>
                <span class="text-gray-600">Porsea, Sumatera Utara</span>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-3 text-emerald-800 text-sm min-h-[72px]">
              <div class="font-semibold">Harga Petani</div>
              <div class="text-lg font-bold mt-1">Rp 4.500/ kg</div>
              <div class="text-xs text-emerald-700 mt-1">Total Hasil Panen: 10.000 kg</div>
            </div>

            <div class="mt-3 text-xs text-gray-500">Penjual: Petani Jagung Jaya</div>

            <div class="mt-4">
              <a href="#" class="inline-flex items-center justify-center w-full px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-500 text-sm">Lihat Detail & Tinjau Lokasi</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
        <div class="relative">
          <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/category-page-04-image-card-04.jpg" alt="Kentang" class="w-full h-48 object-cover rounded-t-2xl" />
          <span class="absolute left-3 top-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Tersedia</span>
          <button class="absolute right-3 top-3 bg-white/90 border border-gray-200 rounded-full p-2 shadow-sm flex items-center justify-center">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 10-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 000-7.78z"/></svg>
          </button>
        </div>
        <div class="p-6 flex flex-col justify-between flex-1">
          <div>
            <h3 class="text-lg font-semibold text-gray-800 truncate">Kentang Granola Premium</h3>
            <p class="mt-2 text-sm text-gray-500">Kentang granola premium dari dataran tinggi Dieng. Ukuran besar, cocok untuk pasaras.</p>

            <div class="mt-4 flex items-center text-sm text-gray-600 gap-4">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/></svg>
                <span class="text-sm">4.9</span>
                <span class="text-gray-400">(298)</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/></svg>
                <span class="text-gray-600">Laguboti, Sumatera Utara</span>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-3 text-emerald-800 text-sm min-h-[72px]">
              <div class="font-semibold">Harga Petani</div>
              <div class="text-lg font-bold mt-1">Rp 8.500/ kg</div>
              <div class="text-xs text-emerald-700 mt-1">Total Hasil Panen: 3.000 kg</div>
            </div>

            <div class="mt-3 text-xs text-gray-500">Penjual: Kebun Dieng Sejahtera</div>

            <div class="mt-4">
              <a href="#" class="inline-flex items-center justify-center w-full px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-500 text-sm">Lihat Detail & Tinjau Lokasi</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</x-layout>