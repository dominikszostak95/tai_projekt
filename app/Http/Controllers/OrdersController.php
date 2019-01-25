<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Returns checkout view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        Order::create(
            [
                "customer_id" => session()->get('id'),
                "status" => 1,
                "products_ids" => $requestData['products_ids'][0],
                "products_names" => $requestData['products_names'][0]
            ]
        );

        return redirect('/')->with('message', 'Zamówienie przyjęte do realizacji!');
    }
}
