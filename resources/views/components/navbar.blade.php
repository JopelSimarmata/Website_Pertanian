@php
  // helper kelas aktif (pill hijau + putih)
  function navActive($pattern) {
      return request()->is($pattern)
          ? 'inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-green-600 text-white shadow-sm'
          : 'inline-flex items-center gap-2 px-4 py-2 rounded-xl text-slate-800 hover:text-green-700';
  }
@endphp

<nav class="w-full bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/70 border-b border-slate-100">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="h-16 flex items-center justify-between">
      {{-- LEFT: logo + brand --}}
      <a href="{{ route('home') }}" class="flex items-center gap-3">
       <img src="{{ asset('img/logo.png') }}"
         alt="LadangQu"
         class="h-9 w-9 rounded-xl shadow-lg ring-1 ring-green-200 bg-green-500/90">
        <span class="text-xl font-semibold text-green-700">LadangQu</span>
      </a>


      {{-- CENTER: main nav --}}
      <div class="hidden md:flex items-center gap-2">
        {{-- Beranda (aktif kalau / atau /home) --}}
        <a href="{{ route('home') }}" class="{{ navActive('/') }}">
          <span class="font-semibold">Beranda</span>
        </a>

        {{-- Forum + ikon chat --}}
        <a href="{{ route('forum.index') }}" class="{{ navActive('forum*') }}">
          {{-- chat-bubble-left-right (Heroicons) --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->is('forum*') ? 'text-white' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6M5 20l3-3h8a4 4 0 0 0 4-4V7a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v13z"/>
          </svg>
          <span>Forum</span>
        </a>

        {{-- Marketplace + ikon bag --}}
        <a href="{{ route('market.index') }}" class="{{ navActive('market*') }}">
          {{-- shopping-bag (Heroicons) --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->is('market*') ? 'text-white' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12l-1 11a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L6 8z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8a3 3 0 1 1 6 0"/>
          </svg>
          <span>Marketplace</span>
        </a>
      </div>

      {{-- RIGHT: auth actions --}}
      <div class="flex items-center">
        <a href="{{ route('login') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 text-slate-800 hover:bg-slate-50">
          {{-- user icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 20a8 8 0 1 1 16 0"/>
          </svg>
          <span>Masuk</span>
        </a>

        <a href="{{ route('register') }}"
           class="ml-3 inline-flex items-center px-5 py-2 rounded-xl bg-green-600 text-white font-semibold shadow-[0_6px_20px_-6px_rgba(16,185,129,0.55)] hover:bg-green-700">
          Daftar
        </a>
      </div>
    </div>
  </div>
</nav>
