<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRuquest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->get();
        return view('dashboard.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::whereNotNull('parent_id' , null)->get();
        if($categories->count() == 0){
            return redirect()->route('dashboard.categories.create')->with('error' , 'there is no category, add category to continue');
        }
        return view('dashboard.products.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRuquest $request)
    {
        //
        $data = $request->except(['image']);
        $path = $request->file('image')->store('products');
        $data['image'] = $path;
        product::create($data);
        return redirect()->route('dashboard.products.index')->with('success' , 'product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = product::findOrFail($id);
        $categories = Category::whereNotNull('parent_id' , null)->get();
        return view('dashboard.products.edit' , compact('product' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        //
        $data = $request->except(['image']);
        $product = product::findOrFail($id);
        $old_image = $product->image;

        if($request->has('image')){
            $path = $request->file('image')->store('products');
        }

        $data['image'] = $path ?? $old_image;
        $product->update($data);
        if($request->has('image') && $old_image){
            Storage::delete($old_image);
        }

        return redirect()->route('dashboard.products.index')->with('success' , 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = product::findOrFail($id);
        if ($product) {
            $product->delete();
            Storage::delete($product->image);
            return redirect()->route('dashboard.products.index')->with('success', 'product deleted successfully');
        }
        return redirect()->route('dashboard.products.index')->with('error', 'product not found');
    }
}
