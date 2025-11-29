<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
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
        $products = Product::with('images')
            ->where('seller_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // load visit requests for this farmer
        $requests = VisitRequest::with(['user','product'])
            ->where('seller_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.farmer', compact('user','products','requests'));
    }
}
