<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        return view("Categories",compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:4|max:30',
        ]);

       $cat = Category::create([
           'name' => $request->name
       ]);
        return redirect('/categories')->with('msg', 'Category has been added successfully');
    }

    public function update(Request $request, $id)
    {

            $data = array(
                'name'=>$request->name,
            );
            $cat = Category::find($id);
            $cat->update($data);
            return redirect()->back()->with('msg','Categroy has been updated successfully');
    }

    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->back()->with('msg','Categroy has been deleted successfully');
    }

    // Api
    public function getCategories(){
        $categories = Category::all();
        return response()->json($categories);
    }
}
