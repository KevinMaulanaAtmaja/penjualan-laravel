<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderComplete;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

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
            'invoice_no' => 'restohub' . mt_rand(10000000, 99999999),
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

        $user = Admin::where('role', 'admin')->get();
        Session::forget(['cart', 'coupon']);

        Notification::send($user, new OrderComplete($request->name));
        return redirect()->route('checkout.thanks')->with([
            'message' => 'Order Placed Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function StripeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'stripeToken' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        if (Session::has('coupon')) {
            $discount = Session::get('coupon')['discount_amount'];
            $payableAmount = $totalAmount - $discount;
        } else {
            $discount = 0;
            $payableAmount = $totalAmount;
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $charge = \Stripe\Charge::create([
            'amount' => $payableAmount * 100,
            'currency' => 'usd',
            'description' => 'RestoHub Delivery',
            'source' => $request->stripeToken,
            'metadata' => [
                'order_id' => uniqid(),
                'original_amount' => $totalAmount,
                'discount' => $discount
            ],
        ]);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_type' => 'Stripe',
            'payment_method' => $charge->payment_method,
            'currency' => $charge->currency,
            'transaction_id' => $charge->balance_transaction,
            'amount' => $totalAmount,
            'total_amount' => $payableAmount,
            'order_number' => $charge->metadata->order_id,
            'invoice_no' => 'restohub' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Paid',
            'created_at' => Carbon::now(),
        ]);

        foreach ($cart as $item) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $item['id'],
                'client_id' => $item['client_id'],
                'qty' => $item['quantity'],
                'price' => $item['price'],
                'created_at' => Carbon::now(),
            ]);
        }

        Session::forget('cart');
        Session::forget('coupon');

        return redirect()->route('checkout.thanks')->with([
            'message' => 'Order Placed Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function MarkAsRead(Request $request, $notificationId)
    {
        $user = Auth::guard('admin')->user();
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['count' => $user->unreadNotifications()->count()]);
    }
}
