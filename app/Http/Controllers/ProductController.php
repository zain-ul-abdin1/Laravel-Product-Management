<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(Request $request)
    {
        if ($request->has('category')) {
            $products = Product::where('category_id', $request->category)->get();
        } elseif ($request->has('tag')) {
            $tag = Tag::find($request->tag);
            $products = $tag ? $tag->products : Product::all();
        } else {
            $products = Product::all();
        }
        return view('products.index', compact('products'));
    }
    function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.create', compact('categories', 'tags'));
    }
    function store(ProductRequest $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->category_id = $request->category_id;
        $products->save();

        if ($request->has('tags')) {
            $products->tags()->attach($request->tags);
        }
        return redirect('/products');
    }
    function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.edit', compact('product', 'categories', 'tags'));
    }
    function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        $product->tags()->sync($request->tags ?? []);
        return redirect('/products');
    }
    function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
