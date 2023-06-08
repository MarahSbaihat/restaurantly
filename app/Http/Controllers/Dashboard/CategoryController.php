<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::whereNull('Parent_id')->with('childrens')->get();
        // dd($categories);
        return view('dashboard.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = Category::whereNull('parent_id')->get();
        // $parents = Category::where('parent_id' , null)->get();
        return view('dashboard.categories.create' , compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        // $request->input('name');
        // $request->post('name');
        // $request->query('name');

        // dd($request->except(['_token']) , $request->query('name'));
        $data = $request->except(['_token']);

        // $request->only([]);
        // // $request->except([]);

        // $request->validate([
        //     'name' => 'required',
        //     'status' => ['boolean' , 'required'],
        //     'parent_id' => 'nullable' , 'exists:categories,id'
        // ]);

        // Category::create([
        //     'name' => $request->name,
        //     'status' => $request->boolean('status'),
        //     'parent_id' => $request->parent_id
        // ]);
        Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success' , 'category created');

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
        // dd($id);
        $category = Category::findOrFail($id);
        $parents = Category::whereNull('parent_id')->get();
        return view('dashboard.categories.edit' , compact('parents' , 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
        $data = $request->except(['_token']);
        $category = Category::findOrFail($id);
        $category->update($data);
        return redirect()->route('dashboard.categories.index')->with('success' , 'category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // dd($id);
        // Category::destroy($id);
        $category = Category::findOrFail($id);

        $child_count = $category->childrens->count();
        $product_count = $category->products->count();

        if($child_count > 0){
            return redirect()->back()->with('error' , "this category have ($child_count) child category , you cant delete it");
        }

        if($product_count > 0){
            return redirect()->back()->with('error' , "this category have ($product_count) product , you cant delete it");
        }
        $category->delete();
        return redirect()->back()->with('success' , 'category deleted');

    }
}
