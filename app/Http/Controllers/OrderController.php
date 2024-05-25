<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'address' => 'required|string',
        ]);

        $createdData = ([
            'code' => $this->generateOrderCode(),
            'date' => now(),
            'customer_id' => $validatedData['customer_id'],
            'address' => $validatedData['address'],
            'subtotal' => 0,
            'discount' => 0,
            'total' => 0,
        ]);

        $order = Order::create($createdData);

        return redirect()->route('orders.edit', $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $customers = Customer::all();
        $products = Item::all();
        $order_items = OrderItem::where('order_id', $order->id)->with('item')->get();
        return view('orders.show', compact('customers', 'order', 'products', 'order_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $customers = Customer::all();
        $products = Item::all();
        $order_items = OrderItem::where('order_id', $order->id)->with('item')->get();
        return view('orders.edit', compact('customers', 'order', 'products', 'order_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'discount' => 'required',
            'address' => 'required|string',
        ]);

        $order->update($validatedData);
        $order->total = $order->subtotal - $order->discount;
        $order->save();

        return redirect()->route('orders.edit', $order->id)->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    private function generateOrderCode()
    {
        $date = now()->format('Ymd'); // Format the date as needed, e.g., YYYYMMDD
        $baseCode = 'TR-' . $date . '-';
        $sequence = 1;

        // Generate a unique code by checking the database
        do {
            $orderCode = $baseCode . str_pad($sequence, 3, '0', STR_PAD_LEFT);
            $sequence++;
        } while (Order::where('code', $orderCode)->exists());

        return $orderCode;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItem  $order_item
     * @return \Illuminate\Http\Response
     */
    public function addOrderItem(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'note' => 'nullable|string',
            'order_id' => 'required',
        ]);

        // Calculate the total price
        $totalPrice = $validatedData['price'];
        $dicount = 0;

        // Apply discount if any
        if (!empty($validatedData['discount'])) {
            $totalPrice -= $validatedData['discount'];
            $dicount = $validatedData['discount'];
        }

        // Create the new order item
        $orderItem = new OrderItem();
        $orderItem->order_id = $validatedData['order_id'];
        $orderItem->item_id = $validatedData['product_id'];
        $orderItem->qty = $validatedData['quantity'];
        $orderItem->price = $validatedData['price'];
        $orderItem->total = $totalPrice;
        $orderItem->discount = $dicount;
        $orderItem->note = $validatedData['note'];
        $orderItem->save();

        $order = Order::findOrFail($orderItem->order_id);
        $order->subtotal += $orderItem->total;
        $order->total = $order->subtotal - $order->discount;
        $order->save();


        // Redirect to the order edit page
        return redirect()->route('orders.edit', $validatedData['order_id']);
    }

    public function deleteOrderItem($id)
    {
        $orderItem = OrderItem::find($id);
        $order =  Order::findOrFail($orderItem->order_id);
        $order->subtotal -= $orderItem->total;
        $order->total = $order->subtotal - $order->discount;
        $order->save();
        $orderItem->delete();
        return redirect()->route('orders.edit', $order->id);
    }
}
