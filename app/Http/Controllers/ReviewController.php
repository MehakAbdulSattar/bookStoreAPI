<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function createReview(Request $request)
    {
        $validatedData = $request->validate([
            'review' => 'required|max:500',
            'book_id' => 'required',
        ]);
        
        $review = new Review;
        $review->review = $request->input('review');
        $user=Auth::user();
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
