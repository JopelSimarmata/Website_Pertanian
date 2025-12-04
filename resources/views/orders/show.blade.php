<x-layout>
<x-navbar></x-navbar>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">Detail Order #{{ $order->invoice_number }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column: Order Details -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Informasi Order</h2>
                    <p class="mb-2"><span class="font-medium">Nomor Invoice:</span> {{ $order->invoice_number }}</p>
                    <p class="mb-2"><span class="font-medium">Nama Pelanggan:</span> {{ optional($order->user)->name ?? '—' }}</p>
                    <p class="mb-2"><span class="font-medium">Email Pelanggan:</span> {{ optional($order->user)->email ?? '—' }}</p>
                    <p class="mb-2"><span class="font-medium">Status:</span> <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : ($order->status == 'paid' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800') }}">{{ ucfirst($order->status) }}</span></p>
                    <p class="mb-2"><span class="font-medium">Total Pembayaran:</span> Rp{{ number_format($order->gross_amount, 0, ',', '.') }}</p>
                    <p class="mb-4"><span class="font-medium">Tanggal Order:</span> {{ $order->created_at->format('d M Y H:i') }}</p>

                    <h3 class="text-lg font-semibold mb-3">Item Order</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Produk</th>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Harga</th>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Jumlah</th>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $detail)
                                    <tr class="border-b border-gray-200 last:border-b-0">
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ optional($detail->product)->name ?? ($detail->product_id ?? 'Produk tidak ditemukan') }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-800">Rp{{ number_format($detail->price, 0, ',', '.') }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-800">{{ $detail->quantity }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-800">Rp{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Column: Payment Button -->
                @if($order->status !== 'paid' && isset($snap_token))
                <div class="flex flex-col items-center justify-center bg-gray-50 p-6 rounded-lg shadow-inner">
                    <p class="text-lg font-medium mb-4 text-gray-700">Siap untuk melakukan pembayaran?</p>
                    <button id='pay-button' class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-xl transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Bayar Sekarang
                    </button>
                    <p class="text-sm text-gray-500 mt-4">Total yang harus dibayar: <span class="font-semibold text-gray-800">Rp{{ number_format($order->gross_amount, 0, ',', '.') }}</span></p>
                </div>
                @endif
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