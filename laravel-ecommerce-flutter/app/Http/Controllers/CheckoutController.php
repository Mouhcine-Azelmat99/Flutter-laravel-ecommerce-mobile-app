<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function addProduct(Request $request)
    {
        $user_id = Auth()->id();
        $item = Checkout::where([
            ['user_id',$user_id],
            ['product_id',$request->product_id]
        ])->get();
        if($item->count() > 0){
            return response()->json("products already exist in your cart");
        }else{
        $this->validate($request,[
            'product_id' => 'required',
        ]);
        $item = Checkout::create([
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'user_id' => $user_id,
        ]);
        return response()->json("products has been added successfully");
        }
    }

    public function getCheckout()
    {
        $products = Checkout::where('user_id',Auth()->id())
            ->join('products','checkouts.product_id','=', 'products.id')
            ->get(['products.*','checkouts.qty']);
        return response()->json($products);
    }

    public function order()
    {
        $products = Checkout::where('user_id',Auth()->id())->get();
        $delete_products = Checkout::where('user_id',Auth()->id());
        foreach($products as $product){
            Order::create([
                'product_id' => $product->product_id,
                'qty' => $product->qty,
                'user_id' => $product->user_id,
            ]);
        }
        $delete_products->delete();
        return response()->json("order has been added successfully");
    }
}
