<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<x-layout>
  <x-navbar></x-navbar>

<!-- Hero Section with Slider -->
<section class="bg-gradient-to-br from-green-100 via-white to-green-50 py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between">

        <!-- Left Text -->
        <div class="md:w-1/2 animate-fade">
            <span class="text-green-800 font-semibold bg-green-200 px-3 py-1 rounded-full shadow-sm">
                Platform Pertanian Terpadu
            </span>

            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-5 leading-tight">
                Marketplace & Forum Pertanian <br> Terlengkap di Indonesia
            </h1>

            <p class="text-gray-600 mt-4 mb-6 text-lg">
                Jual beli hasil panen langsung dari petani dengan transaksi aman
                dan diskusi interaktif.
            </p>

            <div class="flex gap-4">
                <a href="/marketplace" class="border border-emerald-600 text-emerald-600 px-6 py-3 rounded-xl hover:bg-emerald-100 transition">
                    Jelajahi Forum
                </a>

                <a href="/marketplace" class="border border-emerald-600 text-emerald-600 px-6 py-3 rounded-xl hover:bg-emerald-100 transition">
                    Lihat Marketplace
                </a>
            </div>
        </div>

        <!-- Slider -->
        <div class="md:w-1/2 mt-10 md:mt-0 md:ml-10 lg:ml-16 relative">

            <div class="relative overflow-hidden rounded-3xl shadow-2xl h-72 md:h-80 lg:h-96">
                <div id="slider" class="flex h-full transition-transform duration-700">

                    <!-- Semua gambar fix ukuran + tidak terpotong -->
                    <div class="min-w-full h-full">
                        <img src="{{ asset('image/farm.jpg') }}" class="w-full h-full object-cover rounded-3xl">
                    </div>

                    <div class="min-w-full h-full">
                        <img src="{{ asset('image/farm2.jpg') }}" class="w-full h-full object-cover rounded-3xl">
                    </div>

                    <div class="min-w-full h-full">
                        <img src="{{ asset('image/farm3.jpg') }}" class="w-full h-full object-cover rounded-3xl">
                    </div>

                </div>
            </div>

            <!-- Dot Indicators -->
            <div id="dots" class="flex justify-center gap-2 mt-4"></div>

        </div>
    </div>
</section>

<!-- Slider Script -->
<script>
    const slider = document.getElementById("slider");
    const dotsContainer = document.getElementById("dots");

    let index = 0;
    const total = slider.children.length;

    // Create dots
    for (let i = 0; i < total; i++) {
        const dot = document.createElement("div");
        dot.className = "w-3 h-3 bg-gray-300 rounded-full cursor-pointer transition";
        dot.addEventListener("click", () => {
            index = i;
            updateSlide();
        });
        dotsContainer.appendChild(dot);
    }

    const dots = dotsContainer.children;

    function updateSlide() {
        slider.style.transform = `translateX(-${index * 100}%)`;

        for (let i = 0; i < dots.length; i++) {
            dots[i].classList.remove("bg-green-600");
            dots[i].classList.add("bg-gray-300");
        }

        dots[index].classList.add("bg-green-600");
    }

    // Auto slide
    setInterval(() => {
        index = (index + 1) % total;
        updateSlide();
    }, 3000);

    // Initial
    updateSlide();
</script>


  <!-- Features Section -->
  <section class="py-20 bg-green-50">
      <div class="max-w-6xl mx-auto px-6 text-center">
          <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-medium">Fitur Unggulan</span>
          <h2 class="text-3xl font-bold text-gray-900 mt-4">Satu Platform, Semua Kebutuhan</h2>
          <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
              Platform lengkap untuk mendukung kegiatan pertanian Anda, dari diskusi hingga transaksi hasil panen.
          </p>

          <div class="grid md:grid-cols-2 gap-10 mt-12">

    <!-- Card 1 -->
    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-lg border border-green-200 
                transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400
                hover:bg-white">
        <h3 class="text-xl font-semibold text-green-700 flex items-center gap-2">
            💬 Forum Diskusi Petani
        </h3>
        <p class="text-gray-600 mt-3 text-left">
            Tempat berbagi pengalaman, mencari solusi, dan berdiskusi seputar pertanian.
        </p>

        <ul class="mt-4 text-gray-600 list-disc list-inside space-y-1 text-left">
            <li>Kategori diskusi lengkap</li>
            <li>Sistem voting & komentar</li>
            <li>Jawaban expert terverifikasi</li>
        </ul>
    </div>

    <!-- Card 2 -->
    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-lg border border-green-200 
                transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-400
                hover:bg-white">
        <h3 class="text-xl font-semibold text-green-700 flex items-center gap-2">
            🛒 Marketplace Hasil Panen
        </h3>
        <p class="text-gray-600 mt-3 text-left">
            Tempat jual beli hasil panen langsung dari petani secara aman.
        </p>

        <ul class="mt-4 text-gray-600 list-disc list-inside space-y-1 text-left">
            <li>Rating & ulasan pembeli</li>
            <li>Metode pembayaran fleksibel</li>
            <li>Pengantaran terpercaya</li>
        </ul>
    </div>

</div>

      </div>
  </section>

<!-- Footer -->
<footer class="bg-green-900 text-gray-200 py-12">
    <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-8 px-6">

        <div>
            <div class="flex items-center gap-3">
                <img src="{{ asset('image/logo.png') }}" class="h-10 w-auto">
                <span class="text-white font-bold text-lg">LadangQu</span>
            </div>
            <p class="text-sm mt-3">
                Platform forum & marketplace petani Indonesia agar aktivitas pertanian semakin mudah dan terhubung.
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
