<x-layout>
<x-navbar></x-navbar>
<div class="max-w-7xl mx-auto px-6 py-12">
  <div class="bg-white">
    <div class="pt-6">
    <nav aria-label="Breadcrumb">
      <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <li>
          <div class="flex items-center">
            <a href="#" class="mr-2 text-sm font-medium text-gray-900">Men</a>
            <svg viewBox="0 0 16 20" width="16" height="20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
              <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
            </svg>
          </div>
        </li>
        <li>
          <div class="flex items-center">
            <a href="#" class="mr-2 text-sm font-medium text-gray-900">Clothing</a>
            <svg viewBox="0 0 16 20" width="16" height="20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
              <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
            </svg>
          </div>
        </li>

        <li class="text-sm">
          <a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">Basic Tee 6-Pack</a>
        </li>
      </ol>
    </nav>

    <!-- Image gallery -->
    <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-8 lg:px-8">
      <img src="{{ $product->image_url ?? 'https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-secondary-product-shot.jpg' }}" alt="{{ $product->name ?? 'Produk' }}" class="row-span-2 aspect-3/4 size-full rounded-lg object-cover max-lg:hidden" />
      <img src="{{ $product->image_url ?? 'https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg' }}" alt="{{ $product->name ?? 'Produk' }}" class="col-start-2 aspect-3/2 size-full rounded-lg object-cover max-lg:hidden" />
      <img src="{{ $product->image_url ?? 'https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg' }}" alt="{{ $product->name ?? 'Produk' }}" class="col-start-2 row-start-2 aspect-3/2 size-full rounded-lg object-cover max-lg:hidden" />
      <img src="{{ $product->image_url ?? 'https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-02-featured-product-shot.jpg' }}" alt="{{ $product->name ?? 'Produk' }}" class="row-span-2 aspect-4/5 size-full object-cover sm:rounded-lg lg:aspect-3/4" />
    </div>

    <!-- Product info -->
    <div class="mx-auto max-w-2xl px-4 pt-6 pb-12 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pt-10 lg:pb-20">
      <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
        <h1 class="text-2xl font-bold text-emerald-800 sm:text-3xl">{{ $product->name ?? 'Produk Tidak Diketahui' }}</h1>
        <div class="mt-3 text-sm text-gray-600">
          <span class="mr-2">Lokasi: <strong>{{ $product->location ?? 'Lokasi tidak tersedia' }}</strong></span>
          <span class="mx-2">·</span>
          <span>Penjual: <strong>{{ $product->seller->name ?? ($product->farmer_email ?? 'Penjual Tidak Diketahui') }}</strong></span>
        </div>
      </div>

      <!-- Actions / Price card -->
      <div class="mt-4 lg:row-span-3 lg:mt-0">
        <h2 class="sr-only">Informasi produk</h2>
        <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-4 text-emerald-800 text-sm">
          <div class="font-semibold">Harga Petani</div>
          <div class="text-2xl font-bold mt-1">Rp {{ number_format($product->price ?? 7000) }} / kg</div>
          <div class="text-xs text-emerald-700 mt-1">Total Hasil Panen: {{ $product->stock ?? '2.000' }} kg</div>
        </div>

        <div class="mt-4">
          <a href="{{ route('visit_requests.create', ['product_id' => $product->product_id ?? 1]) }}" class="w-full inline-flex items-center justify-center px-4 py-3 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-500 text-sm">Ajukan Tinjau Lokasi</a>
        </div>

        <div class="mt-6 text-sm text-gray-600">
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.38 2.455c-.785.57-1.84-.197-1.54-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.622 9.393c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69L9.05 2.927z"/></svg>
            <span class="text-sm">{{ $product->rating ?? '4.8' }} <span class="text-gray-400">({{ $product->reviews_count ?? 0 }})</span></span>
          </div>
        </div>
      </div>

      <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pr-8 lg:pb-16">
        <!-- Description and details -->
        <div>
          <h3 class="sr-only">Description</h3>

          <div class="space-y-6">
            <p class="text-base text-gray-900">{{ $product->description ?? 'Deskripsi produk belum tersedia.' }}</p>
          </div>
        </div>

        <div class="mt-10">
          <h3 class="text-sm font-medium text-gray-900">Highlights</h3>

          <div class="mt-4">
            <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
              <li class="text-gray-400"><span class="text-gray-600">Hand cut and sewn locally</span></li>
              <li class="text-gray-400"><span class="text-gray-600">Dyed with our proprietary colors</span></li>
              <li class="text-gray-400"><span class="text-gray-600">Pre-washed &amp; pre-shrunk</span></li>
              <li class="text-gray-400"><span class="text-gray-600">Ultra-soft 100% cotton</span></li>
            </ul>
          </div>
        </div>

        <div class="mt-10">
          <h2 class="text-sm font-medium text-gray-900">Details</h2>

          <div class="mt-4 space-y-6">
            <p class="text-sm text-gray-600">The 6-Pack includes two black, two white, and two heather gray Basic Tees. Sign up for our subscription service and be the first to get new, exciting colors, like our upcoming &quot;Charcoal Gray&quot; limited release.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</x-layout>