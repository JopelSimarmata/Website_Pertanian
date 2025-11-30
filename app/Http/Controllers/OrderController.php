<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        // get latest payment record for this order (if any)
        $payment = $order->payments()->latest()->first();
        // prefer existing snap token from latest payment if available
        $snap_token = $payment->snap_token ?? null;

        // if there's no snap_token yet and the order isn't paid, create Midtrans transaction and snap token
        if (empty($snap_token) && ($payment === null || ($payment->status ?? '') !== 'paid')) {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');/
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');




        $transaction_details = array(
            'order_id' => $order->invoice_number,
            'gross_amount' => $order->gross_amount,
        );

        $costumer_details = array(
            'first_name' => $order->user->name ?? 'Guest',
            'email' => $order->user->email ?? 'guest@example.com',
        );

        $items = [];
        foreach ($order->orderDetails as $detail) {
            $items[] = array(
                'id' => $detail->product_id,
                'price' => $detail->price,
                'quantity' => $detail->quantity,
                'name' => 'Product '.$detail->product_id,
            );
        }

        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $costumer_details,
            'item_details' => $items,
        );

            try {
                $snap_token = \Midtrans\Snap::getSnapToken($transaction);
                $payment = Payment::updateOrCreate(
                    ['order_id' => $order->id],
                    [
                        'amount' => $order->gross_amount,
                        'status' => 'pending',
                        'snap_token' => $snap_token,
                    ]
                );
                // make sure we use the stored token
                $snap_token = $payment->snap_token ?? $snap_token;
            } catch (\Exception $e) {
                error_log($e->getMessage());
            }


          
        }

        return view('orders.show', compact('order','snap_token'));
    }
}
