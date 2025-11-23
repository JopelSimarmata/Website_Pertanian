<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class VisitRequestController extends Controller
{
    //
    public function index()
    {
        // Only show visit requests for the current authenticated farmer (or all if admin)
        $user = Auth::user();

        // For simplicity: show all pending requests to farmer. In more complex apps,
        // you'd filter by farm ownership or a `farmer_id` column.
        $requests = VisitRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('visit_requests.index', compact('requests'));
    }

    /** Approve a visit request */
    public function approve(Request $request, $id)
    {
        $vr = VisitRequest::find($id);
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request not found');
        }

        $vr->status = 'approved';
        $vr->save();

        return redirect()->route('visit_requests.index')->with('success', 'Permintaan kunjungan disetujui');
    }

    /** Reject a visit request */
    public function reject(Request $request, $id)
    {
        $vr = VisitRequest::find($id);
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request not found');
        }

        $vr->status = 'rejected';
        $vr->save();

            return redirect()->route('visit_requests.index')->with('success', 'Permintaan kunjungan ditolak');
        }

        /** Show form to create a visit request (buyer) */
    public function create(Request $request)
    {
        $productId = $request->query('product_id');
        $product = null;
        if ($productId) {
            $product = Product::where('product_id', $productId)->first();
        }

        return view('visit_requests.create', compact('product'));
    }

    /** Store visit request submitted by buyer */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'product_id' => 'required|integer',
            'seller_id' => 'nullable|integer',
            'quantity' => 'required|integer|min:1',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'notes' => 'nullable|string|max:1000',
        ]);

        $vr = VisitRequest::create([
            'buyer_id' => $user->id,
            'seller_id' => $data['seller_id'] ?? null,
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'visit_date' => $data['visit_date'],
            'visit_time' => $data['visit_time'],
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('visit_requests.index')->with('success', 'Permintaan kunjungan berhasil dikirim');
    }


}
