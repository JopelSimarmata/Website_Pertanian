<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $attributes = $__attributesOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__attributesOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $component = $__componentOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__componentOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
	
	<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
		<div>
			<h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Permintaan Kunjungan</h1>
			<p class="mt-1 text-sm text-gray-500">Kelola semua permintaan kunjungan ke kebun Anda</p>
		</div>
		<?php if(auth()->guard()->check()): ?>
			<?php if((auth()->user()->role ?? '') === 'tengkulak'): ?>
				<a href="<?php echo e(route('marketplace')); ?>" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 shadow-sm transition">
					<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
					</svg>
					Ajukan Kunjungan Baru
				</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>

	
	<?php if(session('success')): ?>
		<div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-center gap-3">
			<svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
			<span class="text-green-800"><?php echo e(session('success')); ?></span>
		</div>
	<?php endif; ?>
	<?php if(session('error')): ?>
		<div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 flex items-center gap-3">
			<svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
			<span class="text-red-800"><?php echo e(session('error')); ?></span>
		</div>
	<?php endif; ?>

	
	<?php
		$totalRequests = $requests->count();
		$pendingCount = $requests->where('status', 'pending')->count() + $requests->whereNull('status')->count();
		$approvedCount = $requests->where('status', 'approved')->count();
		$rejectedCount = $requests->where('status', 'rejected')->count();
	?>
	<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
		<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
			<div class="flex items-center gap-3">
				<div class="p-2 bg-gray-100 rounded-lg">
					<svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
					</svg>
				</div>
				<div>
					<p class="text-2xl font-bold text-gray-900"><?php echo e($totalRequests); ?></p>
					<p class="text-xs text-gray-500">Total Permintaan</p>
				</div>
			</div>
		</div>
		<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
			<div class="flex items-center gap-3">
				<div class="p-2 bg-amber-100 rounded-lg">
					<svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
				</div>
				<div>
					<p class="text-2xl font-bold text-amber-600"><?php echo e($pendingCount); ?></p>
					<p class="text-xs text-gray-500">Menunggu</p>
				</div>
			</div>
		</div>
		<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
			<div class="flex items-center gap-3">
				<div class="p-2 bg-green-100 rounded-lg">
					<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
				</div>
				<div>
					<p class="text-2xl font-bold text-green-600"><?php echo e($approvedCount); ?></p>
					<p class="text-xs text-gray-500">Disetujui</p>
				</div>
			</div>
		</div>
		<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
			<div class="flex items-center gap-3">
				<div class="p-2 bg-red-100 rounded-lg">
					<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
				</div>
				<div>
					<p class="text-2xl font-bold text-red-600"><?php echo e($rejectedCount); ?></p>
					<p class="text-xs text-gray-500">Ditolak</p>
				</div>
			</div>
		</div>
	</div>

	
	<div class="space-y-4">
		<?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			<?php
				$me = auth()->user();
				// Determine counterparty
				$other = $req->user ?? null;
				$otherRole = 'Pembeli';
				if ($me) {
					if (strtolower($me->role ?? '') === 'petani') {
						$other = $req->user ?? $req->seller ?? null;
						$otherRole = 'Tengkulak';
					} elseif (strtolower($me->role ?? '') === 'tengkulak') {
						$other = $req->seller ?? $req->user ?? null;
						$otherRole = 'Petani';
					} else {
						$other = $req->seller ?? $req->user ?? null;
						$otherRole = $req->seller ? 'Petani' : 'Tengkulak';
					}
				}
				
				// Avatar
				$defaultPhoto = 'https://ui-avatars.com/api/?name=' . urlencode($other->name ?? 'U') . '&color=047857&background=d1fae5';
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
				$name = $other->name ?? 'Pengguna';
				$email = $other->email ?? '-';

				// Product info
				$product = $req->product;
				$productThumb = null;
				if ($product) {
					$thumb = optional($product->images->first())->path ?? $product->image_url ?? null;
					if ($thumb) {
						$productThumb = preg_match('/^https?:\/\//', $thumb) ? $thumb : asset(ltrim($thumb, '/'));
					}
				}

				// Status styling
				$statusClass = match($req->status) {
					'approved' => 'bg-green-100 text-green-800',
					'rejected' => 'bg-red-100 text-red-800',
					'cancelled' => 'bg-gray-100 text-gray-800',
					default => 'bg-amber-100 text-amber-800',
				};
				$statusText = match($req->status) {
					'approved' => 'Disetujui',
					'rejected' => 'Ditolak',
					'cancelled' => 'Dibatalkan',
					default => 'Menunggu',
				};
			?>

			<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
				<div class="p-4 sm:p-6">
					<div class="flex flex-col lg:flex-row lg:items-start gap-4">
						
						<div class="flex-1 min-w-0">
							<div class="flex items-start gap-4">
								
								<img src="<?php echo e($photo); ?>" alt="<?php echo e($name); ?>" class="h-12 w-12 rounded-full object-cover border-2 border-emerald-100 shrink-0" />
								
								<div class="flex-1 min-w-0">
									
									<div class="flex flex-wrap items-center gap-2">
										<h3 class="text-base font-semibold text-gray-900 truncate"><?php echo e($name); ?></h3>
										<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
											<?php echo e($otherRole); ?>

										</span>
										<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium <?php echo e($statusClass); ?>">
											<?php echo e($statusText); ?>

										</span>
									</div>
									<p class="text-sm text-gray-500 truncate"><?php echo e($email); ?></p>

									
									<?php if($product): ?>
										<div class="mt-3 flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
											<?php if($productThumb): ?>
												<img src="<?php echo e($productThumb); ?>" alt="<?php echo e($product->name); ?>" class="w-12 h-12 object-cover rounded-lg shrink-0">
											<?php else: ?>
												<div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center shrink-0">
													<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
													</svg>
												</div>
											<?php endif; ?>
											<div class="min-w-0">
												<p class="text-sm font-medium text-gray-900 truncate"><?php echo e($product->name); ?></p>
												<p class="text-xs text-gray-500">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?> / <?php echo e($product->unit ?? 'kg'); ?></p>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>

						
						<div class="lg:w-64 shrink-0">
							<div class="grid grid-cols-2 lg:grid-cols-1 gap-3 text-sm">
								<div class="flex items-center gap-2">
									<svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									</svg>
									<div>
										<p class="text-xs text-gray-500">Tanggal Kunjungan</p>
										<p class="font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($req->visit_date)->format('d M Y')); ?></p>
									</div>
								</div>
								<div class="flex items-center gap-2">
									<svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
									</svg>
									<div>
										<p class="text-xs text-gray-500">Waktu</p>
										<p class="font-medium text-gray-900"><?php echo e($req->visit_time ?? '-'); ?></p>
									</div>
								</div>
								<div class="flex items-center gap-2">
									<svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
									</svg>
									<div>
										<p class="text-xs text-gray-500">Jumlah</p>
										<p class="font-medium text-gray-900"><?php echo e($req->quantity); ?> <?php echo e($product->unit ?? 'unit'); ?></p>
									</div>
								</div>
								<?php if($req->notes): ?>
									<div class="flex items-start gap-2 col-span-2 lg:col-span-1">
										<svg class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
										</svg>
										<div>
											<p class="text-xs text-gray-500">Catatan</p>
											<p class="text-gray-700 text-xs"><?php echo e(Str::limit($req->notes, 50)); ?></p>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>

						
						<div class="flex flex-wrap items-center gap-2 lg:w-48 lg:justify-end shrink-0">
							<?php $me = auth()->user(); ?>
							
							<?php if($req->status === 'pending' || $req->status === null): ?>
								
								<?php if($me && (($me->role ?? '') === 'petani' && $me->id === $req->seller_id) || ($me && ($me->role ?? '') === 'admin')): ?>
									<form action="<?php echo e(route('visit_requests.approve', $req->request_id)); ?>" method="POST" class="inline">
										<?php echo csrf_field(); ?>
										<button type="submit" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-500 transition">
											<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
											</svg>
											Setujui
										</button>
									</form>
									<form action="<?php echo e(route('visit_requests.reject', $req->request_id)); ?>" method="POST" class="inline">
										<?php echo csrf_field(); ?>
										<button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-500 transition">
											<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
											</svg>
											Tolak
										</button>
									</form>
								<?php elseif($me && $me->id === $req->buyer_id): ?>
									
									<form action="<?php echo e(route('visit_requests.cancel', $req->request_id)); ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan permintaan ini?')">
										<?php echo csrf_field(); ?>
										<button type="submit" class="inline-flex items-center px-3 py-1.5 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-500 transition">
											<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
											</svg>
											Batalkan
										</button>
									</form>
									<span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Menunggu keputusan petani</span>
								<?php else: ?>
									<span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Menunggu keputusan petani</span>
								<?php endif; ?>
							<?php elseif($req->status === 'approved'): ?>
								
								<?php if($me && $me->id === $req->buyer_id): ?>
									<?php
										$hasPayment = \App\Models\Order::where('request_id', $req->request_id)->where('status','paid')->exists();
									?>
									<?php if(!$hasPayment): ?>
										<a href="<?php echo e(route('payments.create', ['request_id' => $req->request_id])); ?>" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-500 transition">
											<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
											</svg>
											Bayar Sekarang
										</a>
									<?php else: ?>
										<span class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 text-sm font-medium rounded-lg">
											<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
											</svg>
											Sudah Dibayar
										</span>
									<?php endif; ?>
								<?php else: ?>
									<span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Menunggu pembayaran</span>
								<?php endif; ?>
							<?php elseif($req->status === 'rejected'): ?>
								<span class="text-xs text-red-600 bg-red-50 px-2 py-1 rounded">Permintaan ditolak</span>
							<?php elseif($req->status === 'cancelled'): ?>
								<span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded">Dibatalkan</span>
							<?php endif; ?>

							
							<?php if(auth()->guard()->check()): ?>
								<a href="<?php echo e(route('visit_requests.show', $req->request_id)); ?>" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
									<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
									</svg>
									Detail
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>

				
				<div class="px-4 sm:px-6 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
					<span>Dibuat <?php echo e($req->created_at->diffForHumans()); ?></span>
					<span>ID: #<?php echo e($req->request_id); ?></span>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			
			<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
				<div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
					<svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
					</svg>
				</div>
				<h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada permintaan kunjungan</h3>
				<p class="text-gray-500 mb-6">Permintaan kunjungan dari pembeli akan muncul di sini.</p>
				<?php if(auth()->guard()->check()): ?>
					<?php if((auth()->user()->role ?? '') === 'tengkulak'): ?>
						<a href="<?php echo e(route('marketplace')); ?>" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition">
							<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
							</svg>
							Jelajahi Marketplace
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\Users\asus3\Downloads\projext papwe\Website_Pertanian\resources\views/visit_requests/index.blade.php ENDPATH**/ ?>