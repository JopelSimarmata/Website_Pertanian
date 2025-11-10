@extends('layouts.app')

@section('content')

<!-- HERO -->
<section id="marketplace" class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-12 relative overflow-hidden">
        <div class="grid lg:grid-cols-2 gap-8 items-center">

            <div class="space-y-6">
                <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full font-semibold">
                    <span class="h-2 w-2 rounded-full bg-green-600 inline-block"></span>
                    Platform Pertanian Terpadu
                </span>

                <h1 class="text-[56px] md:text-[64px] lg:text-[72px] font-extrabold text-green-700 leading-tight">
                    Marketplace<br />Pertanian Terpadu
                </h1>

                <p class="text-lg text-gray-700 max-w-3xl">
                    Platform jual-beli hasil panen langsung dari petani dengan sistem transaksi aman. Petani dapat menjual sayuran, buah-buahan, biji-bijian, dan hasil panen lainnya. Pembeli dapat berbelanja dengan mudah, dan semua dapat berdiskusi di forum.
                </p>

                <div class="flex flex-wrap gap-4 mt-6">
                    <a href="#forum" class="inline-flex items-center gap-3 px-6 py-3 bg-green-600 text-white rounded-xl shadow-md hover:bg-green-700">
                        <!-- chat icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6M5 20l3-3h8a4 4 0 0 0 4-4V7a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v13z"/>
                        </svg>
                        Jelajahi Forum
                    </a>

                    <a href="#marketplace" class="inline-flex items-center gap-3 px-6 py-3 border-2 border-green-200 rounded-xl hover:bg-white">
                        <!-- bag icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12l-1 11a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 8z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8a3 3 0 1 1 6 0"/>
                        </svg>
                        Lihat Marketplace
                    </a>
                </div>
            </div>

            <div class="flex justify-end lg:pr-6">
                <div class="bg-white rounded-2xl p-4 shadow-2xl transform translate-y-0 lg:translate-y-6" style="box-shadow: 0 50px 120px rgba(16,185,129,0.12);">
                    <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=abcd" alt="Ladang" class="w-[600px] max-w-full h-96 object-cover rounded-xl border-6 border-white" />
                </div>
            </div>

        </div>
    </div>
</section>

<!-- STATS -->
<section class="bg-white py-10">
    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center px-6">
        <div class="space-y-2">
            <div class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-50 mx-auto">
                <!-- users icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-4-4h-1"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 20H4v-2a4 4 0 0 1 4-4h1"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="text-2xl font-bold text-green-600">10,000+</div>
            <div class="text-sm text-gray-600">Petani Aktif</div>
        </div>

        <div class="space-y-2">
            <div class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-50 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6M5 20l3-3h8a4 4 0 0 0 4-4V7a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v13z"/></svg>
            </div>
            <div class="text-2xl font-bold text-green-600">5,000+</div>
            <div class="text-sm text-gray-600">Diskusi Forum</div>
        </div>

        <div class="space-y-2">
            <div class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-50 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M5 7v11a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v4"/></svg>
            </div>
            <div class="text-2xl font-bold text-green-600">2,500+</div>
            <div class="text-sm text-gray-600">Hasil Panen Dijual</div>
        </div>

        <div class="space-y-2">
            <div class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-50 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2v6"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 9a3 3 0 1 1 6 0c0 1.5-3 3-3 3"/></svg>
            </div>
            <div class="text-2xl font-bold text-green-600">1,200+</div>
            <div class="text-sm text-gray-600">Tips & Artikel</div>
        </div>

    </div>
</section>

<!-- FEATURES -->
<section class="max-w-6xl mx-auto px-6 mt-12">
    <div class="text-center">
        <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">
            Fitur Unggulan
        </span>
        <h2 class="text-3xl lg:text-4xl font-extrabold text-green-700 mt-6">Satu Platform, Semua Kebutuhan</h2>
        <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Platform lengkap untuk mendukung kegiatan pertanian Anda dari diskusi hingga transaksi</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 mt-10">
        <div class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
            <div class="flex items-start gap-4">
                <div class="h-12 w-12 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6M5 20l3-3h8a4 4 0 0 0 4-4V7a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v13z"/></svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Forum Diskusi</h3>
                    <p class="text-gray-600 mt-2">Berbagi pengalaman, bertanya jawab, dan belajar dari petani berpengalaman. Diskusikan tips penanaman, penanganan hama, dan strategi pertanian modern.</p>
                    <ul class="mt-4 space-y-2 text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Kategori diskusi lengkap
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Sistem voting dan komentar
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Expert verified answers
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-md border border-gray-100">
            <div class="flex items-start gap-4">
                <div class="h-12 w-12 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12l-1 11a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 8z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 8a3 3 0 1 1 6 0"/></svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Marketplace Hasil Panen</h3>
                    <p class="text-gray-600 mt-2">Jual beli hasil panen dengan aman dan mudah. Temukan sayuran segar, buah-buahan berkualitas, biji-bijian, rempah-rempah, dan umbi-umbian langsung dari petani.</p>
                    <ul class="mt-4 space-y-2 text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Produk terverifikasi
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Rating dan review pembeli
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Sistem pembayaran aman
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
