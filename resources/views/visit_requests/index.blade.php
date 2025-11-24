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
					<div class="flex items-start gap-4">
						<img src="{{ $req->user->profile_photo_url ?? 'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?auto=format&fit=facearea&facepad=2&w=80&h=80&q=80' }}" alt="{{ $req->user->name }}" class="h-12 w-12 rounded-full object-cover" />
						<div>
							<div class="text-sm font-medium text-gray-900">{{ $req->user->name }}</div>
							<div class="text-xs text-gray-500">{{ $req->user->email }}</div>
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
						@if($req->status === 'pending' || $req->status === null)
							<form action="{{ route('visit_requests.approve', $req->request_id) }}" method="POST">
								@csrf
								<button type="submit" class="bg-emerald-600 text-white px-3 py-1.5 rounded-md">Setujui</button>
							</form>
							<form action="{{ route('visit_requests.reject', $req->request_id) }}" method="POST">
								@csrf
								<button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-md">Tolak</button>
							</form>
						@else
							<span class="text-sm text-gray-500">Tidak ada aksi</span>
						@endif
					</div>
				</div>
			@empty
				<div class="bg-white shadow sm:rounded-lg p-6 text-gray-600">Belum ada permintaan kunjungan.</div>
			@endforelse
		</div>
	</div>

</x-layout>