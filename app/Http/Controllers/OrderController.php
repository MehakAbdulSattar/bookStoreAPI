<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{
    public function showAllOrders()
    {
        $orders = Order::all();
        return response()->json($orders, Response::HTTP_OK);
    }

    public function createOrder(Request $request)
    {
        $userId=auth()->user()->id;


        $order = Order::create([
            'user_id' => $userId,
            'status' => $request->status,
        ]);

        $cartItems = Cart::where('user_id', $userId)->get();
     
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
            $cartItem->delete();
        }


        return response()->json($order, Response::HTTP_CREATED);
    }

    public function showOrder($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        // Return the order in a JSON response
        return response()->json($order, Response::HTTP_OK);
    }

    public function updateOrder(Request $request, $id)
    {
        // Find the order by ID
        $userId=auth()->user()->id;
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        // Fetch items from the session cart
        $cartItems = Cart::where('user_id', $userId)->get();

        // Loop through cart items and update order items
        foreach ($cartItems as $cartItem) {
            $bookId = $cartItem['book_id'];
            $quantity = $cartItem['quantity'];
            $price = $cartItem['price'];

            // Find the associated order item (assuming you have a unique constraint)
            $orderItem = OrderItem::where('order_id', $order->id)
                ->where('book_id', $bookId)
                ->first();

            if ($orderItem) {
                // Update the order item
                $orderItem->update([
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }
        }

        // Recalculate the total price for the order based on updated order items
        $totalPrice = OrderItem::where('order_id', $order->id)->sum('price');

        // Update the order's total price
        $order->update([
            'total_price' => $totalPrice,
            'status'=>$request->status]);

        return response()->json($order, Response::HTTP_OK);
    }

    public function deleteOrder($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

        // Delete the order
        $order->delete();
        return response()->json(['message' => 'Order removed']);
    }

    public function showOrdersByUserId($user_id)
    {
        // Find orders for the specified user
        $orders = Order::where('user_id', $user_id)->get();

        // Check if any orders were found
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], Response::HTTP_NOT_FOUND);
        }

        // Return the orders in a JSON response
        return response()->json($orders, Response::HTTP_OK);
    }


}
