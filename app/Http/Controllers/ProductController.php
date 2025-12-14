<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategories;
use App\Models\ProductReviews;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // build base query with eager loading
        $query = Product::with(['images', 'seller', 'category'])->withCount('reviews');

        // search across name, description, category and seller name
        if ($q = $request->query('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhereHas('seller', function ($seller) use ($q) {
                        $seller->where('name', 'like', "%{$q}%");
                    })
                    ->orWhereHas('category', function ($cat) use ($q) {
                        $cat->where('slug', 'like', "%{$q}%")->orWhere('name', 'like', "%{$q}%");
                    });
            });
        }

        // filter by category (accept id or slug)
        if ($category = $request->query('category')) {
            if ($category !== 'all' && $category !== '') {
                if (is_numeric($category)) {
                    $query->where('category_id', (int) $category);
                } else {
                    $query->whereHas('category', function ($c) use ($category) {
                        $c->where('slug', $category)->orWhere('name', $category);
                    });
                }
            }
        }

        // price range
        if ($min = $request->query('min_price')) {
            if (is_numeric($min)) {
                $query->where('price', '>=', (int) $min);
            }
        }
        if ($max = $request->query('max_price')) {
            if (is_numeric($max)) {
                $query->where('price', '<=', (int) $max);
            }
        }

        // sorting
        $sort = $request->query('sort');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(20)->withQueryString();

        // categories for filter dropdown
        $categories = ProductCategories::orderBy('slug')->get();

        return view('marketplace.index', compact('products', 'categories'));
    }

    /**
     * Show single product detail
     */
    public function show($id)
    {
        $product = Product::with(['seller', 'category', 'images', 'reviews.buyer'])
            ->withCount('reviews')
            ->findOrFail($id);

        // Calculate average rating
        $avgRating = $product->reviews->avg('rating') ?? 0;
        $product->calculated_rating = round($avgRating, 1);

        // Rating distribution
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $product->reviews->where('rating', $i)->count();
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $product->reviews_count > 0 ? round(($count / $product->reviews_count) * 100) : 0
            ];
        }

        // Check if current user can review (must be tengkulak with completed transaction)
        $canReview = false;
        $hasReviewed = false;
        $hasCompletedTransaction = false;
        
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if user already reviewed
            $hasReviewed = ProductReviews::where('product_id', $id)
                ->where('buyer_id', $user->id)
                ->exists();
            
            // Check if user has completed transaction (approved visit request)
            if (($user->role ?? '') === 'tengkulak') {
                $hasCompletedTransaction = \App\Models\VisitRequest::where('product_id', $id)
                    ->where('buyer_id', $user->id)
                    ->where('status', 'approved')
                    ->exists();
                
                // Can review only if has completed transaction and hasn't reviewed yet
                if ($hasCompletedTransaction && !$hasReviewed) {
                    $canReview = true;
                }
            }
        }

        return view('marketplace.detail', compact('product', 'ratingDistribution', 'canReview', 'hasReviewed', 'hasCompletedTransaction'));
    }

    /**
     * Store a product review
     */
    public function storeReview(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('show.login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Check if user is tengkulak
        if (($user->role ?? '') !== 'tengkulak') {
            return back()->with('error', 'Hanya pembeli yang dapat memberikan ulasan');
        }

        // Check if product exists
        $product = Product::findOrFail($id);

        // Check if user has completed transaction (approved visit)
        $hasCompletedTransaction = \App\Models\VisitRequest::where('product_id', $id)
            ->where('buyer_id', $user->id)
            ->where('status', 'approved')
            ->exists();

        if (!$hasCompletedTransaction) {
            return back()->with('error', 'Anda hanya dapat memberikan ulasan setelah transaksi selesai (kunjungan disetujui)');
        }

        // Check if user already reviewed
        $existingReview = ProductReviews::where('product_id', $id)
            ->where('buyer_id', $user->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini');
        }

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        ProductReviews::create([
            'product_id' => $id,
            'buyer_id' => $user->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
            'helpful_count' => 0,
        ]);

        // Update product average rating
        $avgRating = ProductReviews::where('product_id', $id)->avg('rating');
        $product->update(['rating' => round($avgRating, 1)]);

        return back()->with('success', 'Ulasan berhasil ditambahkan!');
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

    /**
     * API: Get all products with prices
     */
    public function apiGetProducts(Request $request)
    {
        $query = Product::with(['images', 'seller', 'category']);

        // Filter by category if provided
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category)
                  ->orWhere('name', 'like', '%' . $request->category . '%');
            });
        }

        // Filter by seller if provided
        if ($request->has('seller_id')) {
            $query->where('seller_id', $request->seller_id);
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Pagination
        $perPage = $request->get('per_page', 20);
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products->map(function($product) {
                return [
                    'id' => $product->product_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'unit' => $product->unit,
                    'category' => $product->category ? [
                        'id' => $product->category->category_id,
                        'name' => $product->category->name,
                        'slug' => $product->category->slug,
                    ] : null,
                    'seller' => $product->seller ? [
                        'id' => $product->seller->id,
                        'name' => $product->seller->name,
                    ] : null,
                    'images' => $product->images->map(function($img) {
                        return url($img->path);
                    }),
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ];
            }),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ]);
    }

    /**
     * API: Get single product by ID
     */
    public function apiGetProduct($id)
    {
        $product = Product::with(['images', 'seller', 'category', 'reviews.user'])
            ->where('product_id', $id)
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $product->product_id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'unit' => $product->unit,
                'category' => $product->category ? [
                    'id' => $product->category->category_id,
                    'name' => $product->category->name,
                    'slug' => $product->category->slug,
                ] : null,
                'seller' => $product->seller ? [
                    'id' => $product->seller->id,
                    'name' => $product->seller->name,
                    'email' => $product->seller->email,
                ] : null,
                'images' => $product->images->map(function($img) {
                    return url($img->path);
                }),
                'reviews' => $product->reviews->map(function($review) {
                    return [
                        'id' => $review->review_id,
                        'rating' => $review->rating,
                        'comment' => $review->comment,
                        'user' => $review->user ? $review->user->name : null,
                        'created_at' => $review->created_at,
                    ];
                }),
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ]
        ]);
    }

    /**
     * API: Get product prices only
     */
    public function apiGetPrices(Request $request)
    {
        $query = Product::with('category');

        // Filter by category if provided
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category)
                  ->orWhere('name', 'like', '%' . $request->category . '%');
            });
        }

        $products = $query->get(['product_id', 'name', 'price', 'unit', 'category_id']);

        return response()->json([
            'success' => true,
            'data' => $products->map(function($product) {
                return [
                    'id' => $product->product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'unit' => $product->unit,
                    'category' => $product->category ? $product->category->name : null,
                ];
            })
        ]);
    }

    /**
     * API: Create new product
     */
    public function apiCreateProduct(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'unit' => 'required|string|max:50',
                'category_id' => 'required|exists:product_categories,category_id',
            ]);

            // Get authenticated user or use default seller_id for testing
            $sellerId = auth()->id() ?? 1;

            $product = Product::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? '',
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'unit' => $validated['unit'],
                'category_id' => $validated['category_id'],
                'seller_id' => $sellerId,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => [
                    'id' => $product->product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'unit' => $product->unit,
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Update product
     */
    public function apiUpdateProduct(Request $request, $id)
    {
        try {
            $product = Product::where('product_id', $id)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'price' => 'sometimes|numeric|min:0',
                'stock' => 'sometimes|integer|min:0',
                'unit' => 'sometimes|string|max:50',
                'category_id' => 'sometimes|exists:product_categories,category_id',
            ]);

            $product->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => [
                    'id' => $product->product_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'unit' => $product->unit,
                    'updated_at' => $product->updated_at,
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Delete product
     */
    public function apiDeleteProduct($id)
    {
        try {
            $product = Product::where('product_id', $id)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $productName = $product->name;
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => "Product '{$productName}' deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get product categories
     */
    public function apiGetCategories()
    {
        try {
            $categories = ProductCategories::all();

            return response()->json([
                'success' => true,
                'data' => $categories->map(function($category) {
                    return [
                        'id' => $category->category_id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get categories: ' . $e->getMessage()
            ], 500);
        }
    }
}

