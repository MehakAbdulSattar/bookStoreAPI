<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Order;

class BookController extends Controller
{
    public function showAllBooks()
    {
        $books = Book::all();
        $responseBooks = [];

        foreach ($books as $book) {
            $responseBooks[] = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'cover_image_url' => $book->cover_image_url,
                'description' => $book->description,
                'price' => $book->price,
            ];
        }

        return response()->json($responseBooks);
    }


    public function showBook($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        // Retrieve reviews associated with the book
        $reviews = $book->reviews;

        // Prepare the response data including reviews
        $responseData = [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'cover_image_url' => $book->cover_image_url,
            'description' => $book->description,
            'price' => $book->price,
            'rating'=> $book->rating,
            'reviews' => $reviews, // Include reviews in the response
        ];

        return response()->json($responseData);
    }

    public function giveRating($id, $new_rating)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $userID = Auth::user()->id;
        $bookID = $book->id;

        $orders = Order::where('user_id', $userID)
            ->where('status', 'completed')
            ->whereHas('orderitems', function ($query) use ($bookID) {
                $query->where('book_id', $bookID);
            })
            ->get()
            ->first();

        if (!$orders) {
            return response()->json(['error' => 'You are not eligible for rating'], 404);
        }

        $currentRating = $book->rating;
        $newRating = ($currentRating + $new_rating) / 2;
        $book->rating = $newRating;
        $book->save();

        return response()->json(['message' => 'Rating updated successfully']);
    }
}
