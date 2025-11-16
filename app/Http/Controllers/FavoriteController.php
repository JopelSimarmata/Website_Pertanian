<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /** Toggle favorite for authenticated user */
    public function toggle(Request $request)
    {
        $request->validate(['product_id' => 'required|integer|exists:product,product_id']);

        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $productId = $request->input('product_id');

        $existing = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed']);
        }

        Favorite::create(['user_id' => $user->id, 'product_id' => $productId]);
        return response()->json(['status' => 'added']);
    }
}
