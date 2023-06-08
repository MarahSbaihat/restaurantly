<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function store(Request $request){

        // dd($request->all() , auth()->user()->id , session()->get('cart'));

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
        ]);

        $items = [];

        foreach(session()->get('cart') as $item){
            $items[] = [
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ];
        }

        // foreach(session()->get('cart') as $item){
        //     OrderItems::create([
        //         'order_id' => $order->id,
        //         'product_id' => $item['id'],
        //         'quantity' => $item['quantity'],
        //     ]);
        // }

        $order->items()->createMany($items);

        session()->forget('cart');
        return redirect()->route('checkout' , $order->id)->with('success' , 'order created successfully');
    }
}
