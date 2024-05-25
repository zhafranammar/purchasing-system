<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::count();
        $orders = Order::count();
        $order_items = OrderItem::count();
        $earning = 0;
        $all_orders = Order::all();
        foreach ($all_orders as $order) {
            $earning += $order->total;
        }

        $widget = [
            'users' => $customers,
            'orders' => $orders,
            'order_items' => $order_items,
            'earnings' => $earning,
            //...
        ];

        return view('home', compact('widget'));
    }
}
