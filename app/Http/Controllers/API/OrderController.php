<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'address', 'items.product'])->get();
        return response()->json($orders);
    }

    public function show(Order $order)
    {
        $order->load(['user', 'address', 'items.product']);
        return response()->json($order);
    }
}
