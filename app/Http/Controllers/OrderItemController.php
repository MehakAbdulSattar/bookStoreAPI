<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function index()
    {
        // Retrieve and return a list of order items.
        $orderItems = OrderItem::all();
        return response()->json($orderItems, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validate and create a new order item.
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $orderItem = OrderItem::create($request->all());

        return response()->json($orderItem, Response::HTTP_CREATED);
    }

    public function show(OrderItem $orderItem)
    {
        // Retrieve and return a specific order item.
        return response()->json($orderItem, Response::HTTP_OK);
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        // Validate and update the order item.
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $orderItem->update($request->all());

        return response()->json($orderItem, Response::HTTP_OK);
    }

    public function destroy(OrderItem $orderItem)
    {
        // Delete an order item.
        $orderItem->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

}
