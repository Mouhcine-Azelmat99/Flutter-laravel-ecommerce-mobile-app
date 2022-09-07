<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function addProduct(Request $request)
    // {
    //     $user_id = Auth()->id();

    //     $this->validate($request,[
    //         'product_id' => 'required',
    //     ]);
    //     $item = Order::create([
    //         'product_id' => $request->product_id,
    //         'qty' => $request->qty,
    //         'user_id' => $user_id,
    //     ]);
    //     return response()->json("products has been added successfully");

    // }

    public function getAll(){
        $orders=Order::all();

        $user_ids=Order::all()->pluck('user_id')->unique();
        $i=0;
        $result=[];
        foreach($user_ids as $user_id){
            $result[$i]=Order::where('user_id','=',$user_id)->get();
            $total=0;
            foreach($result[$i] as $item){
                $total=$total + $item->qty * $item->product->price;
            }
            $result[$i]->total=$total;
            $i++;
        }
        return view('orders',compact('result'));
    }

    public function destroy($id)
    {
        $ids=Order::where('user_id','=',$id)->pluck('id');
        Order::destroy($ids);
        return redirect()->back()->with('msg','orders has been deleted successfully');
    }

    public function getOrders()
    {
        $orders = Order::where('user_id',Auth()->id())
            ->join('products','orders.product_id','=', 'products.id')
            ->get(['products.*','orders.qty']);
        return response()->json($orders);
    }
}
