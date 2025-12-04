<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategories;
use App\Models\VisitRequest;
use App\Models\Payments;

class DashboardController extends Controller
{
    /** Show farmer dashboard */
    public function farmer(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        if (($user->role ?? '') !== 'petani') {
            return redirect()->route('marketplace')->with('error', 'Hanya petani yang dapat mengakses dashboard ini');
        }

        // load products for this seller
        $products = Product::with(['images', 'category', 'reviews'])
            ->where('seller_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // load visit requests for this farmer
        $requests = VisitRequest::with(['user','product'])
            ->where('seller_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistics
        $stats = [
            'total_products' => $products->count(),
            'total_stock' => $products->sum('stock'),
            'total_requests' => $requests->count(),
            'pending_requests' => $requests->where('status', 'pending')->count(),
            'approved_requests' => $requests->where('status', 'approved')->count(),
            'rejected_requests' => $requests->where('status', 'rejected')->count(),
            'total_reviews' => $products->sum(fn($p) => $p->reviews->count()),
            'avg_rating' => $products->avg('rating') ?? 0,
            'low_stock_products' => $products->where('stock', '<', 10)->count(),
        ];

        // Recent requests (last 5)
        $recentRequests = $requests->take(5);

        // Top products by rating
        $topProducts = $products->sortByDesc('rating')->take(5);

        // Products needing attention (low stock)
        $lowStockProducts = $products->where('stock', '<', 10)->sortBy('stock');

        return view('dashboard.farmer', compact('user','products','requests','stats','recentRequests','topProducts','lowStockProducts'));
    }

    /** Show create product form */
    public function createProduct()
    {
        $user = Auth::user();
        if (! $user || ($user->role ?? '') !== 'petani') {
            abort(403);
        }

        $categories = ProductCategories::orderBy('slug')->get();
        return view('dashboard.farmer-product-create', compact('categories'));
    }

    /** Store new product */
    public function storeProduct(Request $request)
    {
        $user = Auth::user();
        if (! $user || ($user->role ?? '') !== 'petani') {
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
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|max:10000',
            'image_url' => 'nullable|image|max:10000',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('products', 'public');
            $imageUrl = '/storage/products/' . basename($path);
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (! $file->isValid()) continue;
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'path' => '/storage/products/' . basename($path),
                ]);
            }
        }

        return redirect()->route('dashboard.farmer')->with('success', 'Produk berhasil ditambahkan');
    }

    /** Show edit product form */
    public function editProduct($id)
    {
        $user = Auth::user();
        if (! $user || ($user->role ?? '') !== 'petani') {
            abort(403);
        }

        $product = Product::with('images')->where('seller_id', $user->id)->findOrFail($id);
        $categories = ProductCategories::orderBy('slug')->get();

        return view('dashboard.farmer-product-edit', compact('product', 'categories'));
    }

    /** Update product */
    public function updateProduct(Request $request, $id)
    {
        $user = Auth::user();
        if (! $user || ($user->role ?? '') !== 'petani') {
            abort(403);
        }

        $product = Product::where('seller_id', $user->id)->findOrFail($id);

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
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|max:10000',
            'image_url' => 'nullable|image|max:10000',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer',
        ]);

        // Update main image if uploaded
        if ($request->hasFile('image_url')) {
            // Delete old image
            if ($product->image_url) {
                $oldPath = str_replace('/storage/', '', $product->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image_url')->store('products', 'public');
            $product->image_url = '/storage/products/' . basename($path);
        }

        $product->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'price' => $data['price'],
            'stock' => $data['stock'],
            'unit' => $data['unit'] ?? 'kg',
            'location' => $data['location'] ?? null,
            'farmer_email' => $data['farmer_email'] ?? $user->email,
            'farmer_phone' => $data['farmer_phone'] ?? null,
            'detail_address' => $data['detail_address'] ?? null,
            'image_url' => $product->image_url,
        ]);

        // Delete selected images
        if (!empty($data['delete_images'])) {
            $imagesToDelete = ProductImage::whereIn('id', $data['delete_images'])
                ->where('product_id', $product->product_id)
                ->get();
            
            foreach ($imagesToDelete as $img) {
                $imgPath = str_replace('/storage/', '', $img->path);
                Storage::disk('public')->delete($imgPath);
                $img->delete();
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (! $file->isValid()) continue;
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'path' => '/storage/products/' . basename($path),
                ]);
            }
        }

        return redirect()->route('dashboard.farmer')->with('success', 'Produk berhasil diperbarui');
    }

    /** Delete product */
    public function destroyProduct($id)
    {
        $user = Auth::user();
        if (! $user || ($user->role ?? '') !== 'petani') {
            abort(403);
        }

        $product = Product::with('images')->where('seller_id', $user->id)->findOrFail($id);

        // Delete main image
        if ($product->image_url) {
            $path = str_replace('/storage/', '', $product->image_url);
            Storage::disk('public')->delete($path);
        }

        // Delete all product images
        foreach ($product->images as $img) {
            $imgPath = str_replace('/storage/', '', $img->path);
            Storage::disk('public')->delete($imgPath);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('dashboard.farmer')->with('success', 'Produk berhasil dihapus');
    }
}
