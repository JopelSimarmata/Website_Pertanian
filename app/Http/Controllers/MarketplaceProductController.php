<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MarketplaceProductController extends Controller
{
    /**
     * Show product detail page.
     *
     * This controller intentionally does not change any existing files.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (! $product) {
            // Provide a fallback sample product so the view can be previewed
            $product = (object) [
                'id' => $id,
                'title' => 'Contoh Produk Pertanian',
                'description' => "Ini adalah deskripsi contoh produk. Ubah nanti dengan data sebenarnya dari database.",
                'price' => 'Rp 7.500',
                'unit' => 'kg',
                'location' => 'Contoh, Sumatera Utara',
                'image' => '/image/default-product.jpg',
                'seller' => 'Penjual Contoh',
                'stock' => '2.000 kg',
                'rating' => 4.8,
                'reviews_count' => 123,
            ];
        }

        return view('marketplace.detail', compact('product'));
    }
}
