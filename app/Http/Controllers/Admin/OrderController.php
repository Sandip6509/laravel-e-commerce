<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('customerData')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function orderStatus(Request $request, $id)
    {
        Order::where('id', $id)->update(['status' => $request->status ?? null]);
        return redirect()->back()->with('success', 'Order Status Changed Successfully!');
    }

    public function orderItem(Request $request, $id)
    {
        $orderItem = Order::where('id',$id)->with('lineitemsData')->first();
        return view('admin.orders.lineitem',compact('orderItem'));
    }
}
