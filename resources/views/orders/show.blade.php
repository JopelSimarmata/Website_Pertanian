<x-layout>
<x-navbar></x-navbar>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Header --}}
  <div class="mb-6">
    <div class="flex items-center justify-between mb-2">
      <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan</h1>
      <a href="/marketplace" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
        ← Kembali ke Marketplace
      </a>
    </div>
    <p class="text-sm text-gray-500">Invoice #{{ $order->invoice_number }}</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-6">
      
      {{-- Order Status Card --}}
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-bold text-gray-900">Status Pesanan</h2>
          @if($order->status === 'pending')
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
              <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
              </svg>
              Menunggu Pembayaran
            </span>
          @elseif($order->status === 'paid')
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-800">
              <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              Lunas
            </span>
          @else
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-800">
              <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              {{ ucfirst($order->status) }}
            </span>
          @endif
        </div>
        
        <div class="grid grid-cols-2 gap-4 text-sm">
          <div>
            <p class="text-gray-500 mb-1">Tanggal Pesanan</p>
            <p class="font-semibold text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
          </div>
          <div>
            <p class="text-gray-500 mb-1">Metode Pembayaran</p>
            <p class="font-semibold text-gray-900">Midtrans Payment Gateway</p>
          </div>
        </div>
      </div>

      {{-- Product Items --}}
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
          <h2 class="text-lg font-bold text-gray-900">Produk Pesanan</h2>
        </div>
        
        <div class="divide-y divide-gray-200">
          @foreach ($order->orderDetails as $detail)
            <div class="p-6 hover:bg-gray-50 transition">
              <div class="flex gap-4">
                {{-- Product Image --}}
                <div class="flex-shrink-0">
                  @if($detail->product && $detail->product->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $detail->product->images->first()->image_path) }}" 
                         alt="{{ $detail->product->name }}"
                         class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                  @else
                    <div class="w-20 h-20 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                      <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                  @endif
                </div>

                {{-- Product Details --}}
                <div class="flex-1 min-w-0">
                  <h3 class="font-semibold text-gray-900 mb-1">
                    {{ $detail->product->name ?? 'Produk tidak tersedia' }}
                  </h3>
                  
                  @if($detail->product)
                    <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-2">
                      @if($detail->product->category)
                        <span class="inline-flex items-center">
                          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                          </svg>
                          {{ $detail->product->category->name ?? 'Uncategorized' }}
                        </span>
                      @endif
                      
                      @if($detail->product->unit)
                        <span class="inline-flex items-center">
                          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                          </svg>
                          Per {{ $detail->product->unit }}
                        </span>
                      @endif
                    </div>
                  @endif

                  <div class="flex items-center justify-between mt-3">
                    <div class="text-sm">
                      <span class="text-gray-500">Harga:</span>
                      <span class="font-semibold text-gray-900 ml-2">Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-sm">
                      <span class="text-gray-500">Jumlah:</span>
                      <span class="font-semibold text-gray-900 ml-2">{{ $detail->quantity }} {{ $detail->product->unit ?? 'pcs' }}</span>
                    </div>
                    <div class="text-right">
                      <p class="text-xs text-gray-500 mb-1">Subtotal</p>
                      <p class="font-bold text-emerald-600">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Customer Information --}}
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Pembeli</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
            <p class="font-semibold text-gray-900">{{ $order->user->name ?? '—' }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-500 mb-1">Email</p>
            <p class="font-semibold text-gray-900">{{ $order->user->email ?? '—' }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-500 mb-1">Role</p>
            <p class="font-semibold text-gray-900">{{ ucfirst($order->user->role ?? '—') }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-500 mb-1">Nomor Invoice</p>
            <p class="font-mono text-sm font-semibold text-gray-900">{{ $order->invoice_number }}</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Sidebar: Summary & Payment --}}
    <div class="lg:col-span-1">
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
        
        <div class="space-y-3 pb-4 border-b border-gray-200">
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Subtotal ({{ $order->orderDetails->count() }} item)</span>
            <span class="font-medium text-gray-900">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Biaya Admin</span>
            <span class="font-medium text-gray-900">Rp 0</span>
          </div>
        </div>

        <div class="flex justify-between items-center py-4 border-b border-gray-200">
          <span class="text-lg font-bold text-gray-900">Total</span>
          <span class="text-2xl font-bold text-emerald-600">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
        </div>

        @if($order->status !== 'paid' && isset($snap_token))
          <div class="mt-6">
            <button id='pay-button' class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 shadow-lg">
              <span class="flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Bayar Sekarang
              </span>
            </button>
            <p class="text-xs text-center text-gray-500 mt-3">Pembayaran aman dengan Midtrans</p>
          </div>
        @elseif($order->status === 'paid')
          <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
            <div class="flex items-center text-green-800">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span class="font-semibold">Pembayaran Berhasil</span>
            </div>
            <p class="text-sm text-green-700 mt-2">Pesanan Anda telah dibayar dan diproses.</p>
          </div>
        @endif
      </div>
    </div>

  </div>
</div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snap_token }}', {
          // Optional
                    onSuccess: function(result){
                        // redirect to success page for this order so server can show actual status
                        window.location.href = "{{ url('payment/success') }}?order={{ $order->invoice_number }}";
                    },
          // Optional
          onPending: function(result){
                    
           
          },
          // Optional
          onError: function(result){
           
          }
        });
      };
    </script>

</x-layout>