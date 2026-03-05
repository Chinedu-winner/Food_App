<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Show the tracking page for the given order. The user must own
     * the order or the route is unauthorized.
     */
    public function track(Order $order)
    {
        // simple authorization check: only owner can view
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        return view('orders.track', ['order' => $order]);
    }

    /**
     * Return JSON status + location for polling from the frontend.
     */
    public function status(Order $order): JsonResponse
    {
        if (Auth::id() !== $order->user_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return response()->json([
            'status' => $order->status,
            'latitude' => $order->latitude,
            'longitude' => $order->longitude,
            'updated_at' => $order->updated_at,
        ]);
    }
}
