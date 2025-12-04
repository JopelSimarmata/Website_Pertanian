<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\VisitRequest;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function handleCallback(Request $request)
    {
        // configure Midtrans from config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status ?? null;
        $fraud = $notif->fraud_status ?? null;

        $orderId = $notif->order_id ?? ($request->input('order_id') ?? null);

        $order = Order::where('invoice_number', $orderId)->first();
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        if ($transaction == 'capture') {
            if ($fraud == 'accept') {
                $this->updateOrderStatus($order, 'paid', $notif);
            }
        }
        else if ($transaction == 'cancel') {
            $this->updateOrderStatus($order, 'cancelled', $notif);
        }
        else if ($transaction == 'deny') {
            $this->updateOrderStatus($order, 'failed', $notif);
        }
        else if ($transaction == 'settlement') {
            $this->updateOrderStatus($order, 'paid', $notif);
        }
    }

    /**
     * Show a friendly payment success page for a given order.
     * Expects a query parameter `order` containing the invoice_number.
     */
    public function success(Request $request)
    {
        $orderInvoice = $request->query('order') ?? $request->input('order');
        if (! $orderInvoice) {
            return redirect()->route('home')->with('error', 'Order not specified');
        }

        $order = Order::where('invoice_number', $orderInvoice)->first();
        if (! $order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        // prefer order status, fall back to latest payment status if present
        $payment = $order->payments()->latest()->first();
        $status = $order->status ?? ($payment->status ?? 'pending');

        return view('payments.success', compact('order', 'status'));
    }

    protected function updateOrderStatus(Order $order, string $status, $notif)
    {
        $order->update(['status' => $status]);
        // create or update payment record
        Payment::updateOrCreate(
            ['order_id' => $order->id],[
                'amount' => $notif->gross_amount ?? 0,
                'status' => $status,
                'payment_date' => in_array($status, ['paid', 'settlement']) ? now() : null
            ]
        );
    }




    public function create(Request $request)
    {
        $requestId = $request->input('request_id');
        if (! $requestId) {
            return redirect()->back()->with('error', 'Request ID not provided');
        }

        $vr = VisitRequest::find($requestId);
        if (! $vr) {
            return redirect()->back()->with('error', 'Visit request not found');
        }

        // ensure the current user is the buyer
        $me = Auth::user();
        if (! $me || $me->id !== $vr->buyer_id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $product = $vr->product;
        $quantity = $vr->quantity ?? 1;
        $price = $product->price ?? 0;
        $gross = $price * $quantity;

        // Check if an order for this specific visit request already exists.
        // We tie orders to visit_requests via `request_id` so each request gets its own invoice.
        $order = Order::where('request_id', $requestId)->first();

        if (! $order) {
            $order = Order::create([
                'user_id' => $vr->buyer_id,
                'request_id' => $requestId,
                'gross_amount' => $gross,
                'status' => 'pending',
            ]);

            // create order detail
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->product_id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return redirect()->route('orders.show', ['order' => $order->invoice_number]);
    }


}
