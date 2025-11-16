@extends('layouts.app')

@section('title', $product->title ?? 'Detail Produk')

@section('content')
<div class="max-w-7xl mx-auto bg-white rounded-lg shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Left: gallery + info (span 2 on md) -->
        <div class="md:col-span-2">
            <div class="bg-gray-100 rounded overflow-hidden relative">
                <img id="mainImage" src="{{ $product->image ?? asset('image/placeholder.png') }}" alt="{{ $product->title }}" class="w-full h-96 object-cover">

                                <!-- Favorite (heart) button top-right -->
                                @guest
                                    <button type="button" class="absolute top-3 right-3 bg-white/90 rounded-full p-2 shadow require-login" aria-label="Tambahkan ke favorit" title="Tambahkan ke favorit (silakan masuk terlebih dahulu)">
                                        <!-- outline heart for guest (black stroke) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.172 7.172a4.5 4.5 0 016.364 0L12 9.636l2.464-2.464a4.5 4.5 0 116.364 6.364L12 21.364l-8.828-8.828a4.5 4.5 0 010-6.364z" />
                                        </svg>
                                    </button>
                                @else
                                    <button type="button" class="absolute top-3 right-3 bg-white/90 rounded-full p-2 shadow hover:bg-white js-toggle-favorite" aria-label="Hapus dari favorit" data-product-id="{{ $product->product_id ?? $product->id }}">
                                        <!-- filled heart for logged-in users -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657 3.172 10.828a4 4 0 010-5.656z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @endguest
            </div>

            <div class="mt-3 flex gap-2">
                @php
                    $thumbs = [$product->image ?? asset('image/placeholder.png')];
                @endphp
                @foreach($thumbs as $thumb)
                    <button type="button" onclick="document.getElementById('mainImage').src='{{ $thumb }}'" class="w-20 h-20 overflow-hidden rounded border">
                        <img src="{{ $thumb }}" alt="thumb" class="w-full h-full object-cover">
                    </button>
                @endforeach
            </div>

            <div class="mt-6">
                <h1 class="text-2xl font-bold text-emerald-800">{{ $product->title }}</h1>
                <p class="text-sm text-gray-600 mt-2">{{ $product->description }}</p>

                <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="bg-emerald-50 border border-emerald-200 rounded px-4 py-3">
                        <div class="text-xs text-gray-500">Harga Petani</div>
                        <div class="font-semibold text-lg text-emerald-700">{{ $product->price }} <span class="text-sm text-gray-600">/{{ $product->unit ?? 'pak' }}</span></div>
                        <div class="text-xs text-gray-400">Total Hasil Panen: {{ $product->stock ?? 'N/A' }}</div>
                    </div>

                    <div class="text-sm text-gray-600">
                        <div class="flex items-center gap-2"><svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.839-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/></svg>
                            <span>{{ $product->rating ?? '-' }} • {{ $product->reviews_count ?? 0 }} ulasan</span>
                        </div>
                        <div class="mt-2">Lokasi: <span class="text-gray-800">{{ $product->location }}</span></div>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-4">
                    @guest
                        <a href="#" class="inline-block bg-emerald-600 text-white rounded px-4 py-2 require-login">Lihat Detail & Tinjau Lokasi</a>
                    @else
                        <a href="#" class="inline-block bg-emerald-600 text-white rounded px-4 py-2">Lihat Detail & Tinjau Lokasi</a>
                    @endguest
                    <a href="#" class="inline-block border border-emerald-600 text-emerald-600 rounded px-4 py-2">Hubungi Penjual</a>
                </div>
            </div>
        </div>

        <!-- Right: seller card + map -->
        <aside class="md:col-span-1">
            <div class="border rounded-lg p-4 shadow-sm bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 font-bold">{{ strtoupper(substr($product->seller ?? 'P',0,1)) }}</div>
                    <div>
                        <div class="font-semibold text-gray-800">{{ $product->seller ?? 'Penjual' }}</div>
                        <div class="text-xs text-gray-500">Penjual • Bergabung 2024</div>
                    </div>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div class="mb-2"><strong>Lokasi</strong><div class="text-gray-700">{{ $product->location }}</div></div>
                    <div class="mb-2"><strong>Stok</strong><div class="text-gray-700">{{ $product->stock ?? 'N/A' }}</div></div>
                </div>

                <div class="mt-4">
                    <a href="#" class="block w-full text-center bg-emerald-600 text-white rounded px-3 py-2">Hubungi via Pesan</a>
                </div>
            </div>

            <div class="mt-4 border rounded-lg overflow-hidden">
                <!-- Map preview: link to Google Maps query using lokasi -->
                @php $mapQuery = urlencode($product->location ?? 'Indonesia'); @endphp
                <a href="https://www.google.com/maps/search/?api=1&query={{ $mapQuery }}" target="_blank" rel="noopener noreferrer">
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $mapQuery }}&zoom=10&size=600x300&markers=color:green%7C{{ $mapQuery }}&key=YOUR_API_KEY" alt="Map preview" class="w-full h-40 object-cover">
                </a>
                <div class="p-2 text-xs text-gray-500">Klik untuk buka peta</div>
            </div>
        </aside>
    </div>

    <div class="mt-6 border-t pt-4">
        <h2 class="font-semibold text-gray-700">Informasi Tambahan</h2>
        <ul class="text-sm text-gray-600 mt-2 space-y-1">
            <li>Stok: {{ $product->stock ?? 'N/A' }}</li>
            <li>Rating: {{ $product->rating ?? '-' }} ({{ $product->reviews_count ?? 0 }} ulasan)</li>
        </ul>
    </div>
</div>

<script>
// small helper: swap main image when clicking thumbs (already inline on buttons)
</script>
@include('marketplace._login_prompt_modal')

<script>
    (function(){
        var tokenMeta = document.querySelector('meta[name="csrf-token"]');
        var csrf = tokenMeta ? tokenMeta.getAttribute('content') : '{{ csrf_token() }}';

        function toggleFavorite(btn){
            var id = btn.getAttribute('data-product-id');
            if(!id) return;
            btn.disabled = true;

            fetch('/favorites/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: id })
            }).then(function(res){ return res.json(); })
            .then(function(json){
                if(json.status === 'added'){
                    btn.innerHTML = '<svg class="h-5 w-5 text-rose-500" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657 3.172 10.828a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>';
                } else if(json.status === 'removed'){
                    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3.172 7.172a4.5 4.5 0 016.364 0L12 9.636l2.464-2.464a4.5 4.5 0 116.364 6.364L12 21.364l-8.828-8.828a4.5 4.5 0 010-6.364z" /></svg>';
                }
            }).catch(function(){
            }).finally(function(){ btn.disabled = false; });
        }

        document.addEventListener('click', function(e){
            var t = e.target.closest && e.target.closest('.js-toggle-favorite');
            if(t){ e.preventDefault(); toggleFavorite(t); }
        });
    })();
</script>

@endsection
