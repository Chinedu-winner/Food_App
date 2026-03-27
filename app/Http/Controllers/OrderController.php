<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller{
    public function track(Order $order){
        return view('orders.track', ['order' => $order]);
    }

    public function status(Order $order): JsonResponse{
        if (Auth::id() !== $order->user_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return response()->json([
            'status' => $order->status,
            'latitude' => $order->latitude ?? null,
            'longitude' => $order->longitude ?? null,
            'updated_at' => $order->updated_at,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'cart' => 'required|array|min:1',
        ]);

        $cartItems = $request->input('cart'); 

        // Calculate total
        $totalPrice = collect($cartItems)->sum(function($item){
            return $item['price'] * $item['quantity'];
        });

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total'   => $totalPrice,
            'status'  => Order::STATUS_PENDING,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id'  => $item['food_id'],
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
            ]);
        }

        // Redirect to track page
        return redirect()->route('orders.track', $order->id)
                         ->with('success', 'Order placed successfully!');
    }
}