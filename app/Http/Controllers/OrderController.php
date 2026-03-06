<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller{
    public function track(Order $order){
        if (Auth::id() !== $order->user_id) {
            abort(403, 'You are not allowed to view this order.');
        }
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
    
}