<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // ambil produk terbaru, paginasi 20 per halaman
        // eager load review count for display
        // eager load images to avoid N+1 when rendering thumbnails
        $products = Product::with('images')->withCount('reviews')->orderBy('created_at', 'desc')->paginate(20);

        return view('marketplace.index', compact('products'));
    }

    /**
     * Show single product detail
     */
    public function show($id)
    {
        $product = Product::with(['seller', 'category'])->withCount('reviews')->findOrFail($id);

        return view('marketplace.detail', compact('product'));
    }

    /** Show upload form for Petani */
    public function create()
    {
        $user = Auth::user();
        if (! $user || (($user->role ?? '') !== 'petani')) {
            abort(403);
        }

        return view('marketplace.upload');
    }

    /** Store uploaded product */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user || (($user->role ?? '') !== 'petani')) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:product_categories,category_id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'farmer_email' => 'nullable|email|max:255',
            'farmer_phone' => 'nullable|string|max:50',
            'detail_address' => 'nullable|string',
            // support array of images
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|max:10000',
            'image_url' => 'nullable|image|max:10000',
        ]);
        // legacy single image support + multiple images support
        $imageUrl = null;
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('products', 'public');
            $filename = basename($path);
            $imageUrl = '/storage/products/' . $filename;
        }

        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'seller_id' => $user->id,
            'price' => $data['price'],
            'stock' => $data['stock'],
            'unit' => $data['unit'] ?? 'kg',
            'location' => $data['location'] ?? null,
            'farmer_email' => $data['farmer_email'] ?? $user->email,
            'farmer_phone' => $data['farmer_phone'] ?? null,
            'detail_address' => $data['detail_address'] ?? null,
            'image_url' => $imageUrl,
        ]);

        // handle multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (! $file->isValid()) {
                    continue;
                }
                $path = $file->store('products', 'public');
                $filename = basename($path);
                $imagePath = '/storage/products/' . $filename;

                ProductImage::create([
                    'product_id' => $product->product_id,
                    'path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('marketplace')->with('success', 'Produk berhasil diunggah');
    }
}
