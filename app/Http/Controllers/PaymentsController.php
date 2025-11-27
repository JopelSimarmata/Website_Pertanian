<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payments;
use App\Models\VisitRequest;

class PaymentsController extends Controller
{
    /** Show payment form for a visit request (buyer) */
    public function create(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        $requestId = $request->query('request_id');
        if (! $requestId) {
            return redirect()->route('visit_requests.index')->with('error', 'Request tidak ditemukan');
        }

        $vr = VisitRequest::with('product')->where('request_id', $requestId)->first();
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request tidak ditemukan');
        }

        // only buyer can pay and only when request approved
        if ($user->id !== $vr->buyer_id) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak memiliki izin membayar untuk permintaan ini');
        }

        if ($vr->status !== 'approved') {
            return redirect()->route('visit_requests.index')->with('error', 'Permintaan belum disetujui oleh petani');
        }

        // compute amount: fallback to product price * quantity
        $amount = ($vr->product->price ?? 0) * ($vr->quantity ?? 1);

        return view('payments.create', compact('vr','amount'));
    }

    /** Store payment record (buyer submits payment) */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'request_id' => 'required|integer|exists:visit_requests,request_id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
        ]);

        $vr = VisitRequest::where('request_id', $data['request_id'])->first();
        if (! $vr) {
            return redirect()->route('visit_requests.index')->with('error', 'Request tidak ditemukan');
        }

        if ($user->id !== $vr->buyer_id) {
            return redirect()->route('visit_requests.index')->with('error', 'Anda tidak memiliki izin membayar untuk permintaan ini');
        }

        if ($vr->status !== 'approved') {
            return redirect()->route('visit_requests.index')->with('error', 'Permintaan belum disetujui');
        }

        // create payment record with status 'pending'
        Payments::create([
            'buyer_id' => $user->id,
            'request_id' => $vr->request_id,
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('visit_requests.index')->with('success', 'Pembayaran tercatat. Silakan ikuti instruksi selanjutnya untuk konfirmasi.');
    }
}
