<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // ambil produk terbaru, paginasi 20 per halaman
        // eager load review count for display
        $products = Product::withCount('reviews')->orderBy('created_at', 'desc')->paginate(20);

        return view('marketplace.index', compact('products'));
    }

    /** Show upload form for Petani */
    public function create()
    {
        $user = Auth::user();
        if (! $user || (($user->role ?? '') !== 'Petani')) {
            abort(403);
        }

        return view('marketplace.upload');
    }

    /** Store uploaded product */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user || (($user->role ?? '') !== 'Petani')) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'farmer_email' => 'nullable|email|max:255',
            'farmer_phone' => 'nullable|string|max:50',
            'detail_address' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        // handle image
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/products', $filename);
            // public path (storage link)
            $imageUrl = '/storage/products/' . $filename;
        }

        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'stock' => $data['stock'],
            'unit' => $data['unit'] ?? 'kg',
            'location' => $data['location'] ?? null,
            'farmer_email' => $data['farmer_email'] ?? $user->email,
            'farmer_phone' => $data['farmer_phone'] ?? null,
            'detail_address' => $data['detail_address'] ?? null,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('marketplace')->with('success', 'Produk berhasil diunggah');
    }
}
