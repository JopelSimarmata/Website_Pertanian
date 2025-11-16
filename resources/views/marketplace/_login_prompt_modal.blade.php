<div id="loginPromptModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
  <div class="absolute inset-0 bg-black/40" data-modal-backdrop></div>

  <div class="relative max-w-lg w-full bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="p-6">
      <h3 class="text-lg font-semibold text-gray-800">Login sebagai pembeli untuk mengajukan kunjungan lokasi</h3>
      <p class="text-sm text-gray-600 mt-2">Silakan masuk atau daftar untuk mengajukan permintaan kunjungan lokasi ke penjual dan melihat informasi kunjungan.</p>

      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
        <a href="{{ url('/login') }}" class="block text-center bg-emerald-600 text-white rounded px-4 py-2">Masuk</a>
        <a href="{{ url('/register') }}" class="block text-center border border-emerald-600 text-emerald-600 rounded px-4 py-2">Daftar</a>
      </div>

      <div class="mt-4 text-sm text-gray-500">Atau, Anda dapat melihat detail produk sebagai tamu tetapi harus masuk untuk mengajukan kunjungan.</div>
    </div>

    <div class="p-4 border-t text-right">
      <button data-modal-close class="inline-block px-3 py-2 rounded bg-gray-100 hover:bg-gray-200">Tutup</button>
    </div>
  </div>
</div>

<script>
  // small helper to check for route_exists not available in plain PHP; keep simple behavior
  // Modal open/close handled by buttons with .require-login and data-modal-close
  (function(){
    function openModal(){
      const m = document.getElementById('loginPromptModal');
      if(!m) return; m.classList.remove('hidden'); m.classList.add('flex');
    }
    function closeModal(){
      const m = document.getElementById('loginPromptModal');
      if(!m) return; m.classList.remove('flex'); m.classList.add('hidden');
    }

    document.addEventListener('click', function(e){
      const t = e.target.closest && e.target.closest('.require-login');
      if(t){
        e.preventDefault();
        openModal();
      }

      if(e.target.matches('[data-modal-close]') || e.target.closest('[data-modal-backdrop]')){
        closeModal();
      }
    });
  })();
</script>
