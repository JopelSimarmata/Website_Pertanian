<x-layout>
<x-navbar></x-navbar>

	<div class="max-w-7xl mx-auto px-6 py-12">
		<div class="flex items-center justify-between mb-6">
			<h1 class="text-2xl font-bold text-emerald-800">Permintaan Kunjungan</h1>
		</div>

		@if(session('success'))
			<div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
		@endif
		@if(session('error'))
			<div class="mb-4 p-3 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
		@endif

		<div class="grid gap-4">
			@forelse($requests as $req)
				<div class="bg-white shadow sm:rounded-lg p-4 sm:p-6 flex items-start justify-between">
					@php
						$me = auth()->user();
						// default counterparty: buyer (user)
						$other = $req->user ?? null;
						$otherRole = 'Pembeli';
						if ($me) {
							if (strtolower($me->role ?? '') === 'petani') {
								// farmer sees tengkulak (buyer)
								$other = $req->user ?? $req->seller ?? null;
								$otherRole = 'Pembeli';
							} elseif (strtolower($me->role ?? '') === 'tengkulak') {
								// buyer sees farmer (seller)
								$other = $req->seller ?? $req->user ?? null;
								$otherRole = 'Petani';
							} else {
								// admin/other: prefer seller if exists
								$other = $req->seller ?? $req->user ?? null;
								$otherRole = $req->seller ? 'Petani' : 'Pembeli';
							}
						}
						// compute avatar: prefer user_profiles.avatar (storage), then profile_photo_url, then default
						$defaultPhoto = 'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?auto=format&fit=facearea&facepad=2&w=80&h=80&q=80';
						$photo = $defaultPhoto;
						if ($other) {
							try {
								$dbAvatar = \Illuminate\Support\Facades\DB::table('user_profiles')->where('user_id', $other->id)->value('avatar');
							} catch (\Throwable $e) {
								$dbAvatar = null;
							}
							if (!empty($dbAvatar)) {
								$photo = asset('storage/'.$dbAvatar);
							} elseif (!empty($other->profile_photo_url)) {
								$photo = $other->profile_photo_url;
							}
						}
						$name = $other->name ?? ($other->title ?? 'Pengguna');
						$email = $other->email ?? '-';
					@endphp
					<div class="flex items-start gap-4">
						<img src="{{ $photo }}" alt="{{ $name }}" class="h-12 w-12 rounded-full object-cover" />
						<div>
							<div class="flex items-center gap-2">
								<div class="text-sm font-medium text-gray-900">{{ $name }}</div>
								<span class="text-xs px-2 py-0.5 rounded text-white bg-emerald-600">{{ $otherRole }}</span>
							</div>
							<div class="text-xs text-gray-500">{{ $email }}</div>
							<div class="mt-1 text-sm text-gray-700">Tanggal kunjungan: <strong>{{ $req->visit_date }}</strong></div>
							<div class="mt-1 text-sm">
								Status: 
								@if($req->status === 'approved')
									<span class="text-green-600 font-medium">Disetujui</span>
								@elseif($req->status === 'rejected')
									<span class="text-red-600 font-medium">Ditolak</span>
								@else
									<span class="text-amber-600 font-medium">Menunggu</span>
								@endif
							</div>
						</div>
					</div>

					<div class="flex items-center gap-2">
						@php $me = auth()->user(); @endphp
						@if($req->status === 'pending' || $req->status === null)
							{{-- only allow seller (petani) for this request or admin to see approve/reject buttons --}}
							@if($me && (($me->role ?? '') === 'petani' && $me->id === $req->seller_id) || ($me && ($me->role ?? '') === 'admin'))
								<form action="{{ route('visit_requests.approve', $req->request_id) }}" method="POST">
									@csrf
									<button type="submit" class="bg-emerald-600 text-white px-3 py-1.5 rounded-md">Setujui</button>
								</form>
								<form action="{{ route('visit_requests.reject', $req->request_id) }}" method="POST">
									@csrf
									<button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-md">Tolak</button>
								</form>
							@else
								{{-- for tengkulak (buyer) or other users show waiting message --}}
								<span class="text-sm text-gray-500">Menunggu keputusan petani</span>
							@endif
						@elseif($req->status === 'approved')
						@elseif($req->status === 'approved')
							{{-- If approved and current user is the buyer, show payment button (if not already paid) --}}
							@if($me && $me->id === $req->buyer_id)
								@php
									// check if a payment exists for this request and not completed
									$hasPayment = \App\Models\Payments::where('request_id', $req->request_id)->whereIn('status',['completed','paid'])->exists();
								@endphp
								@if(!$hasPayment)
									<a href="{{ route('payments.create', ['request_id' => $req->request_id]) }}" class="bg-emerald-600 text-white px-3 py-1.5 rounded-md">Lakukan Pembayaran</a>
								@else
									<span class="text-sm text-gray-500">Pembayaran tercatat</span>
								@endif
							@else
								<span class="text-sm text-gray-500">Menunggu pembayaran dari pembeli</span>
							@endif
												@else
														<span class="text-sm text-gray-500">Tidak ada aksi</span>
												@endif
												{{-- Detail button visible to authenticated users --}}
												@auth
													<a href="{{ route('visit_requests.show', $req->request_id) }}" class="px-2 py-1 text-sm border rounded text-gray-700">Detail</a>
												@endauth
					</div>
				</div>
			@empty
				<div class="bg-white shadow sm:rounded-lg p-6 text-gray-600">Belum ada permintaan kunjungan.</div>
			@endforelse
		</div>
	</div>

</x-layout>