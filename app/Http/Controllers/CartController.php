<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }

        if (auth()->check()) {
            return view('front.cart' , compact('cart'));
        } else {
            return redirect()->route('signin')->with('error', 'you must login first');
        }
    }

    public function add($id)
    {
        // dd($id);
        $product = product::findOrFail($id);
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }

        if(array_key_exists($product->id , $cart)){
            $cart[$product->id]['quantity'] += 1;
        }else{
            $cart[$product->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1,
                "id" => $product->id
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success' , 'add to cart successfully');
    }
}
