<?php

namespace App\Http\Controllers;

// app/Http/Controllers/OrderController.php


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // app/Http/Controllers/OrderController.php


    public function index()
    {
        $orders = Order::select('order_id', 'created_at', 'type', 'paymentMethod', 'payment', 'total', 'change')
            ->distinct('order_id')
            ->get();

        return view('index', compact('orders'));
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'type' => 'required',
            'dish_name' => 'required|array',
            'quantity' => 'required|array',
            'price' => 'required|array',
            'payment' => 'required',
            'total' => 'required',
            'change' => 'required',
            'paymentMethod' => 'required',
        ]);

        // Generate a single order_id for this transaction
        $orderId = 'CHM' . mt_rand(100000000, 999999999);

        // Loop through the dish data and create individual orders
        $dishNames = $request->input('dish_name');
        $quantities = $request->input('quantity');
        $prices = $request->input('price');

        foreach ($dishNames as $index => $dishName) {
            Order::create([
                'order_id' => $orderId,
                'type' => $validatedData['type'],
                'dish_name' => $dishName,
                'quantity' => $quantities[$index],
                'price' => $prices[$index],
                'payment' => $validatedData['payment'],
                'total' => $validatedData['total'],
                'change' => $validatedData['change'],
                'paymentMethod' => $validatedData['paymentMethod'],
            ]);
        }

        // Redirect or return a response as needed
        return response()->json(['success' => true]);
    }
    public function show($orderId)
    {

        $orders = Order::where('order_id', $orderId)->get();

        return response()->json($orders);
    }
}
