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
        return view('OrderView::admin.order.index',compact('orders'));
    }

    public function show(Request $request,$id)
    {
        $order = Order::findOrFail($id);
        return view('OrderView::admin.order.order',compact('order'));
    }
}
