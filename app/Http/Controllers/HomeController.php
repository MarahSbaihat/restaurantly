<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('front.index');
    }

    public function category(Request $request) {
        $querParams = $request->query();
        // dd($querParams);
        $categories = Category::with('childrens')->whereNull('Parent_id')->where('status' , true)->get();
        $products = Product::query();

        if(isset($querParams['category'])){
            $products = $products->where('category_id' , $querParams['category']);
        }

        $products = $products->where('status' , true)->paginate(isset($querParams['select']) ? $querParams['select'] : 3);
        return view('front.category' , compact('categories' , 'products'));
    }

    public function details($id){
        // dd($id);
        $product = Product::findOrFail($id);
        return view('front.details' , compact('product'));
    }

    public function signin(){
        return view('front.auth.signin');
    }

    public function signup(){
        return view('front.auth.signup');
    }
}
