<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    function create()
    {
        return view('products.create');
    }
    function store(ProductRequest $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->save();
        return redirect('/products');
    }
    function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
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
