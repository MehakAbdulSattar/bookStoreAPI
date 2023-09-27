<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function showAllitems()
    {
        // Retrieve and return a list of order items.
        $orderItems = OrderItem::all();
        return response()->json($orderItems, Response::HTTP_OK);
    }

    

    public function showItem($id)
    {
        $orderItem=OrderItem::find($id);
        if(!$orderItem)
        {
            return response()->json('orderitem not found');
        }
        // Retrieve and return a specific order item.
        return response()->json($orderItem, Response::HTTP_OK);
    }


    public function deletItem($id)
    {
        $orderItem=OrderItem::find($id);
        if(!$orderItem)
        {
            return response()->json('orderitem not found');
        }
        // Delete an order item.
        $orderItem->delete();

        return response()->json('Item Delete');
    }

}
