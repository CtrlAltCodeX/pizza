<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrdersController extends Controller
{
    /**
     * All Orders
     *
     * @return void
     */
    public function index()
    {
        $allOrders = Order::with('order_details')->get();

        return response()->json([
            'data' => $allOrders,
            'message' => 'All Orders!!!'
        ]);
    }
}
