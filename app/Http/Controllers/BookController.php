<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Order;

class BookController extends Controller
{
    public function addBookToCatalog(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover_image_url' => 'required|url',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $book = Book::create($validatedData);

        return response()->json(['message' => 'Book added to catalog', 'book' => $book], 201);
    }

    
    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'cover_image_url' => 'url',
            'description' => 'string',
            'price' => 'numeric',
        ]);

        $book->update($validatedData);

        return response()->json(['message' => 'Book updated', 'book' => $book]);
    }

    public function deleteBook($id)
    {

        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }


        $book->delete();

        return response()->json(['message' => 'Book deleted']);
    }


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

        $reviews = $book->reviews;
        $responseData = [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'cover_image_url' => $book->cover_image_url,
            'description' => $book->description,
            'price' => $book->price,
            'rating'=> $book->rating,
            'reviews' => $reviews,
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
