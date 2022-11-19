<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Lineitem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if (empty($user)) {
            return redirect()->route('login');
        } else {
            $cartData = Cart::with('getProductData')->where('user_id', $user->id)->get();
            $subtotal = 0;
            $shipping = 10;
            $tax = 10; //in percentage
            foreach ($cartData as $value) {
                $productData = $value->getProductData;
                $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
                $subtotal += $price * $value->quantity;
            }
            $taxAmount = round(($subtotal * $tax) / 100);
            $total = round($subtotal + $shipping + $taxAmount);
            return view('cart', compact('cartData', 'user', 'subtotal', 'shipping', 'tax', 'total', 'taxAmount'));
        }
    }

    public function store(Request $request)
    {
        $requestData = $request->except('_token');
        foreach ($requestData['cart'] as $key => $value) {
            if ($requestData['cartQty'][$key] < 1) {
                Cart::where('id', $value)->delete();
            } else {
                Cart::where('id', $value)->update(['quantity' => $requestData['cartQty'][$key] ?? 1]);
            }
        }
        Comment::where('user_id', auth()->user()->id)->update(['comment' => $requestData['specialNotes']]);
        return redirect()->back()->with('success', 'Cart has been updated!');
    }

    public function addCart(Request $request)
    {
        if (empty(Auth::user())) {
            return redirect()->route('login');
        } else {
            $requestData = $request->except('_token');
            $requestData['user_id'] = auth()->user()->id;
            Cart::create($requestData);
            return redirect()->route('cart.index')->with('success', 'Product added successfully!');
        }
    }

    public function storeOrder(Request $request)
    {
        $requestData = $request->all();
        $user = auth()->user();
        $cartData = Cart::with('getProductData')->where('user_id', $user->id)->get();
        $commentData = Comment::where('user_id', auth()->user()->id)->value('comment');
        $subtotal = 0;
        $shipping = 10;
        $tax = 10; //in percentage
        $lineItemData = [];
        foreach ($cartData as $value) {
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
            $subtotal += $price * $value->quantity;
        }
        $taxAmount = round(($subtotal * $tax) / 100);
        $total = round($subtotal + $shipping + $taxAmount);
        $orderData = Order::create([
            'user_id' => $user->id,
            'sub_total' => $subtotal ?? 0,
            'shipping' => $shipping ?? 0,
            'tax_amount' => $taxAmount ?? 0,
            'tax_rate' => $tax ?? 0,
            'amount' => $total ?? 0,
            'comment' => $commentData,
            'status' => 'Order Placed',
        ]);
        foreach ($cartData as $value) {
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
            Lineitem::create([
                'user_id' => $user->id,
                'order_id' => $orderData->id,
                'product_id' => $productData->id,
                'quantity' => $value->quantity ?? 0,
                'price' => $price ?? 0,
                'total_price' => $price * $value->quantity ?? 0,
            ]);
        }
        Cart::where('user_id', $user->id)->delete();
        Comment::where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'Your order has been placed successfully!');
    }
}
