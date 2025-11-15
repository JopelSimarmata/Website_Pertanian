
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<x-layout>
  <x-navbar></x-navbar>

  <!-- Hero Section -->
  <section class="bg-gradient-to-b from-green-50 to-white py-20">
      <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
          <div class="md:w-1/2">
              <span class="text-green-700 font-semibold bg-green-100 px-3 py-1 rounded-full">🌿 Platform Pertanian Terpadu</span>
              <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 leading-tight">
                  Marketplace <br> Pertanian Terpadu
              </h1>
              <p class="text-gray-600 mt-4 mb-6">
                  Platform jual beli hasil panen langsung dari petani dengan sistem transaksi aman. 
                  Petani dapat menjual sayuran, buah-buahan, biji-bijian, dan hasil panen lainnya.
              </p>
              <div class="flex gap-4">
                  <a href="#" class="bg-green-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-green-700">
                      Jelajahi Forum
                  </a>
                  <a href="#" class="border border-green-600 text-green-600 px-5 py-2 rounded-lg font-medium hover:bg-green-50">
                      Lihat Marketplace
                  </a>
              </div>
          </div>

        <div class="md:w-1/2 mt-10 md:mt-0 md:ml-10 lg:ml-16">
            <img src="{{ asset('image/farm.jpg') }}" alt="Ladang" class="rounded-2xl shadow-lg w-full">
        </div>
      </div>
  </section>

  <!-- Features Section -->
  <section class="py-20 bg-green-50">
      <div class="max-w-6xl mx-auto px-6 text-center">
          <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-medium">Fitur Unggulan</span>
          <h2 class="text-3xl font-bold text-gray-900 mt-4">Satu Platform, Semua Kebutuhan</h2>
          <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
              Platform lengkap untuk mendukung kegiatan pertanian Anda, dari diskusi hingga transaksi hasil panen.
          </p>

          <div class="grid md:grid-cols-2 gap-8 mt-12">
              <div class="bg-white p-8 rounded-2xl shadow-md text-left">
                  <h3 class="text-xl font-semibold text-green-700">💬 Forum Diskusi</h3>
                  <p class="text-gray-600 mt-3">
                      Berbagi pengalaman dan belajar dari petani lain dalam berbagai topik pertanian.
                  </p>
                  <ul class="mt-4 text-gray-600 list-disc list-inside space-y-1">
                      <li>Kategori diskusi terstruktur</li>
                      <li>Sistem voting dan komentar</li>
                      <li>Expert verified answers</li>
                  </ul>
              </div>

              <div class="bg-white p-8 rounded-2xl shadow-md text-left">
                  <h3 class="text-xl font-semibold text-green-700">🛒 Marketplace Hasil Panen</h3>
                  <p class="text-gray-600 mt-3">
                      Jual beli hasil panen segar dan olahan secara mudah dan aman.
                  </p>
                  <ul class="mt-4 text-gray-600 list-disc list-inside space-y-1">
                      <li>Rating & ulasan pembeli</li>
                      <li>Pilihan metode pembayaran</li>
                      <li>Sistem pengantaran aman</li>
                  </ul>
              </div>
          </div>
      </div>
  </section>

  <!-- Footer -->
  <footer class="bg-green-900 text-gray-200 py-12">
      <div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-8 px-6">
          <div>
            <div class="flex items-center gap-3">
                <img src="{{ asset('image/logo.png') }}" alt="LadangQu Logo" class="h-10 w-auto">
                <span class="text-white font-bold text-lg">LadangQu</span>
            </div>
              <p class="text-sm mt-3">
                  Platform forum dan marketplace petani Indonesia untuk aktivitas pertanian lebih mudah dan terkoneksi.
              </p>
          </div>
          <div>
              <h4 class="font-semibold text-white mb-3">Forum</h4>
              <ul class="space-y-2 text-sm">
                  <li><a href="#" class="hover:underline">Diskusi Umum</a></li>
                  <li><a href="#" class="hover:underline">Tips & Trik</a></li>
                  <li><a href="#" class="hover:underline">Hama & Penyakit</a></li>
              </ul>
          </div>
          <div>
              <h4 class="font-semibold text-white mb-3">Platform</h4>
              <ul class="space-y-2 text-sm">
                  <li><a href="#" class="hover:underline">Untuk Petani</a></li>
                  <li><a href="#" class="hover:underline">Untuk Pembeli</a></li>
                  <li><a href="#" class="hover:underline">Panduan</a></li>
              </ul>
          </div>
          <div>
              <h4 class="font-semibold text-white mb-3">Kontak</h4>
              <p class="text-sm">Email: info@ladangqu.com</p>
              <p class="text-sm">Telp: +62 812 3456 7890</p>
          </div>
      </div>
      <div class="text-center text-sm text-gray-400 mt-10">
          © 2025 LadangQu. All rights reserved.
      </div>
  </footer>

</x-layout>
