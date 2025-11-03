<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function CashOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $carts = session()->get('cart', []);
        $subtotal = 0;

        foreach ($carts as $cart) {
            $subtotal += $cart['price'] * $cart['quantity'];
        }

        $discount = 0;
        if (Session::has('coupon')) {
            $discount = Session::get('coupon')['discount_amount'];
        }

        $payable = max($subtotal - $discount, 0);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',
            'currency' => 'USD',
            'amount' => $subtotal,
            'total_amount' => $payable,
            'invoice_no' => 'easyshop' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart['id'],
                'client_id' => $cart['client_id'],
                'qty' => $cart['quantity'],
                'price' => $cart['price'],
                'created_at' => Carbon::now(),
            ]);
        }

        Session::forget(['cart', 'coupon']);

        return redirect()->route('checkout.thanks')->with([
            'message' => 'Order Placed Successfully',
            'alert-type' => 'success'
        ]);
    }
}
