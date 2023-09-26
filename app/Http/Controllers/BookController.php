<?php 

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function showAllBooks()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function showBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        return response()->json($book);
    }


    public function giveRating($id, $new_rating)
    {
        $book = Book::find($id);
        if (!$book) 
        {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $rating=$book->rating;
        $rating=($rating+$new_rating)/2;
        $book->rating=$rating;
        $book->save();
        return response()->json($book);
    }
}
