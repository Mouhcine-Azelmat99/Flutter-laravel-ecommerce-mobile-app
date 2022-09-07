<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::all();
        return view('products',compact('products'));
    }
    public function create()
    {
        $categories=Category::all();
        return view('AddProduct',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:4|max:50',
            'desc' => 'required|min:10',
            'price' => 'required|numeric',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        $img_name = time().'_'.$request->name.'.'.$request->image->extension();
        $request->image->move(public_path('images'),$img_name);
       $item = Product::create([
           'name' => $request->name,
           'desc' => $request->desc,
           'price' => $request->price,
           'category_id' => $request->category_id,
           'img' => $img_name,
       ]);
        return redirect('/products/create')->with('msg', 'products has been added successfully');
    }

    public function update(Request $request, $id)
    {
        if($request->image){
            $img_name = time().'_'.$request->name.'.'.$request->image->extension();
            $request->image->move(public_path('images'),$img_name);
            $data = array(
                'name'=>$request->name,
                'desc'=>$request->desc,
                'price'=>$request->price,
                'image' => $img_name
            );
            }else{
                $data = array(
                    'name'=>$request->name,
                    'desc'=>$request->desc,
                    'price'=>$request->price,
                );
            }
            $item = Product::find($id);
            $item->update($data);
            return redirect()->back()->with('msg','Item has been updated successfully');
    }

    public function destroy($id)
    {
        $item=Product::find($id);
        $item->delete();
        return redirect()->back()->with('msg','Product has been deleted successfully');
    }

    // Api

    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function getProductsByCategory($id)
    {
        $products = Product::where('category_id',$id)->get();
        return response()->json($products);
    }
}
