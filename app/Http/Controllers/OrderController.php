<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Models\OrderItem;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve and return a list of orders.
        $orders = Order::all();
        return response()->json($orders, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validate and create a new order.
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'status' => 'required|in:pending,processing,completed,canceled',
        // ]);

        // Create the order based on the request data.
        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'total_price' => 0, // Initialize total price to 0
        ]);

        // Fetch items from the session cart
        $cartItems = $request->session()->get('cart', []);
        // Calculate total price and add order items
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $bookId = $cartItem['book_id'];
            $quantity = $cartItem['quantity'];
            $price = $cartItem['price'];

            // Create an order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $bookId,
                'quantity' => $quantity,
                'price' => $price,
            ]);

            // Update the total price
            $totalPrice += $price * $quantity;
        }

        // Update the order's total price
        $order->update(['total_price' => $totalPrice]);

        // Clear the session cart
        Session::forget('cart');

        return response()->json($order, Response::HTTP_CREATED);
    }
    public function show(Order $order)
    {
        // Retrieve and return a specific order.
        return response()->json($order, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        // Validate and update the order.
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'total_price' => 'required|numeric',
        //     'status' => 'required|in:pending,processing,completed,canceled',
        // ]);

        $order=Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        
        $order->update($request->all());

        return response()->json($order, Response::HTTP_OK);
    }

    public function destroy(Order $order)
    {
        // Delete an order.
        $order->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

}
