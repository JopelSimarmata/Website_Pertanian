<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function handdleCallback(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        
        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $orderId = $notif->order_id;

        $order = Order::where('invoice_number', $orderId)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $order->status = 'pending';
            } else if ($fraud == 'accept') {
                $order->status = 'paid';
            }
        } else if ($transaction == 'settlement') {
            $order->status = 'paid';
        } else if ($transaction == 'pending') {
            $order->status = 'pending';
        } else if ($transaction == 'deny') {
            $order->status = 'failed';
        } else if ($transaction == 'expire') {
            $order->status = 'expired';
        } else if ($transaction == 'cancel') {
            $order->status = 'canceled';
        }
    }

    protected function updateOrderPaymentStatus(Order $order,string $status, $notif)
    {
        $order->update(['status' => $status]);

        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'amount' => $notif->gross_amount,
                'status' => $status,
                'payment_date' => in_array($status, ['paid', 'settlement']) ? now() : null
            ]
        );
    }


}
