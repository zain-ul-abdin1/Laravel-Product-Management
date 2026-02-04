<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(Request $request)
    {
        if($request->has('category')){
            $products = Product::where('category_id',$request->category)->get();
        }
        else{

            $products = Product::all();
        }
        return view('products.index', compact('products'));
    }
    function create()
    {
        $categories = Category::all();
        return view('products.create',compact('categories'));
    }
    function store(ProductRequest $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->category_id = $request->category_id;
        $products->save();
        return redirect('/products');
    }
    function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }
    function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect('/products');
    }
    function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
