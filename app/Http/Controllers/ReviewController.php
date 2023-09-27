<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;

class ReviewController extends Controller
{
    public function createReview(Request $request)
    {
        $user= Auth::user();
        $bookID = $request-> input('book_id');
        $userID =$user->id;
        $orders = Order::where('user_id', $userID)->where('status', "completed")
    ->whereHas('orderitems', function ($query) use ($bookID) {
        // Check if the order has items with the specified book ID
        $query->where('book_id', $bookID);
    })
    ->get()->first();
    
    if(!$orders)
    {
        return response()->json(['error' => 'You are not eligble for review'], 404);
    }
        $validatedData = $request->validate([
            'review' => 'required|max:500',
            'book_id' => 'required',
        ]);
        
        $review = new Review;
        $review->review = $request->input('review');
        $review->user_id=$user->id;
        $review->book_id = $request-> input('book_id');
        $review->save();
        
        // Prepare a JSON response indicating success
        $response = [
            'message' => 'Review added successfully',
            'review' => $review, 
        ];

        return response()->json($response, 201);
    }
}
