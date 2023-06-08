<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PaypalController extends Controller
{
    //
    public function create($orderid)
    {
        $order = Order::findOrFail($orderid);
        $client = app('paypal.client');

        $request = new OrdersCreateRequest();
        // dd($request);
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $order->id,
                "amount" => [
                    "value" => $order->amount,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('paypal.cancel', $order->id),
                "return_url" => route('paypal.return', $order->id)
            ]
        ];

        try {
            // dd($client);
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            // dd($response);

            if ($response->statusCode == 201) {
                foreach ($response->result->links as $link) {
                    if ($link->rel == 'approve') {
                        return redirect()->away($link->href);
                    }
                }
            }
        } catch (HttpException $ex) {
            $order->update([
                'status' => 'declined'
            ]);
            return redirect()->route('home')->with('error', 'Order Cancelled');
        }
    }

    public function callback(Request $request ,$orderid)
    {
        $client = app('paypal.client');
        $order = Order::findOrFail($orderid);
        $token = $request->query('token');
        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $request = new OrdersCaptureRequest($token);
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            // dd($response);

            if ($response->statusCode == 201 && $response->result->status == 'COMPLETED') {
                $order->update([
                    'status' => 'completed'
                ]);
                return redirect()->route('home')->with('success', 'Order Completed');
            }
        } catch (HttpException $ex) {
            $order->update([
                'status' => 'declined'
            ]);
            return redirect()->route('home')->with('error', 'Order Cancelled');
        }
    }

    public function cancel($orderid){
        $order = Order::findOrFail($orderid);
        $order->update([
            'status' => 'declined'
        ]);
        return redirect()->route('home')->with('error', 'Order Cancelled');
    }
}
