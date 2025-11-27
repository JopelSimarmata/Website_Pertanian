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

        // Role based listing:
        if ($user && ($user->role ?? '') === 'petani') {
            // show requests for this farmer (seller)
            $requests = VisitRequest::with(['user', 'product'])
                ->where('seller_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($user && ($user->role ?? '') === 'tengkulak') {
            // show requests created by this tengkulak (buyer)
            $requests = VisitRequest::with(['seller', 'product'])
                ->where('buyer_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // admin or others: show all
            $requests = VisitRequest::with(['user', 'seller', 'product'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('visit_requests.index', compact('requests'));
    }

    /** Approve a visit request */
    public function approve(Request $request, $id)
    {
        $vr = VisitRequest::find($id);
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request not found');
        }

        $user = Auth::user();
        if (! $user) {
            return redirect()->route('visit_requests.index')->with('error', 'Unauthorized');
        }

        // Buyer (tengkulak) must not be able to approve their own request
        if ($user->id === $vr->buyer_id) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak dapat menyetujui permintaan kunjungan yang Anda buat');
        }

        // Only seller (farmer) of this product or admin can approve
        $canApprove = ($user->role === 'admin') || ($user->id === $vr->seller_id);
        if (! $canApprove) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak memiliki izin untuk menyetujui permintaan ini');
        }

        $vr->status = 'approved';
        $vr->save();

        return redirect()->route('visit_requests.index')->with('success', 'Permintaan kunjungan disetujui');
    }

    /** Cancel a visit request (buyer) */
    public function cancel(Request $request, $id)
    {
        $vr = VisitRequest::find($id);
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request not found');
        }

        $user = Auth::user();
        if (! $user) {
            return redirect()->route('visit_requests.index')->with('error', 'Unauthorized');
        }

        // only buyer who created it can cancel and only when pending
        if ($user->id !== $vr->buyer_id) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak memiliki izin membatalkan permintaan ini');
        }

        if ($vr->status !== 'pending' && $vr->status !== null) {
            return redirect()->route('visit_requests.index')->with('error', 'Hanya permintaan yang menunggu yang dapat dibatalkan');
        }

        $vr->status = 'cancelled';
        $vr->save();

        return redirect()->route('visit_requests.index')->with('success', 'Permintaan kunjungan dibatalkan');
    }

    /** Show single visit request detail */
    public function show($id)
    {
        $user = Auth::user();
        $vr = VisitRequest::with(['user','seller','product'])->find($id);
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request tidak ditemukan');
        }

        // only related parties or admin can view
        if (! $user) {
            return redirect()->route('login');
        }

        $allowed = ($user->role === 'admin') || ($user->id === $vr->buyer_id) || ($user->id === $vr->seller_id);
        if (! $allowed) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak memiliki izin melihat permintaan ini');
        }

        return view('visit_requests.show', compact('vr','user'));
    }

    /** Reject a visit request */
    public function reject(Request $request, $id)
    {
        $vr = VisitRequest::find($id);
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request not found');
        }
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('visit_requests.index')->with('error', 'Unauthorized');
        }

        // Buyer can't reject/approve own
        if ($user->id === $vr->buyer_id) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak dapat menolak permintaan kunjungan yang Anda buat');
        }

        // Only seller or admin can reject
        $canReject = ($user->role === 'admin') || ($user->id === $vr->seller_id);
        if (! $canReject) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak memiliki izin untuk menolak permintaan ini');
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

        // Only tengkulak can create visit requests (buyers)
        $user = Auth::user();
        if (! $user || ($user->role ?? '') !== 'tengkulak') {
            return redirect()->route('marketplace')->with('error', 'Hanya tengkulak yang dapat mengajukan permintaan kunjungan');
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

        // allow only tengkulak to create
        if (($user->role ?? '') !== 'tengkulak') {
            return redirect()->route('marketplace')->with('error', 'Hanya tengkulak yang dapat mengajukan permintaan kunjungan');
        }

        $data = $request->validate([
            'product_id' => 'required|integer',
            'seller_id' => 'nullable|integer',
            'quantity' => 'required|integer|min:1',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'notes' => 'nullable|string|max:1000',
        ]);


        // If product exists, enforce seller_id from product to avoid spoofing
        $sellerId = $data['seller_id'] ?? null;
        $product = Product::where('product_id', $data['product_id'])->first();
        if ($product) {
            $sellerId = $product->seller_id;
        }

        $vr = VisitRequest::create([
            'buyer_id' => $user->id,
            'seller_id' => $sellerId,
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
