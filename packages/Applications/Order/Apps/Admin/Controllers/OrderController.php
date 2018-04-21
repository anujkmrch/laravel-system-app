<?php

namespace Order\Apps\admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Order\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::get();
        dd($orders);
        // return view('OrderView::admin.order.index');
    }
}
