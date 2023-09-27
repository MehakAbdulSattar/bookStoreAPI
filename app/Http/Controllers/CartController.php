<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;

class CartController extends Controller
{
    public function viewCart(Request $request)
    {
        $user = $request->user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        return response()->json(['cart' => $cartItems]);
    }

    public function addToCart(Request $request)
    {
        $user = $request->user();
        $bookId = $request->input('book_id');
        $book = Book::find($bookId);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $quantity = $request->input('quantity', 1);

        // Check if the item already exists in the user's cart
        $existingCartItem = Cart::where('user_id', $user->id)->where('book_id', $bookId)->first();

        if ($existingCartItem) {
            // Update the quantity of the existing cart item
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            // Create a new cart item for the user
            Cart::create([
                'user_id' => $user->id,
                'book_id' => $bookId,
                'quantity' => $quantity,
                'price' => $book->price,
            ]);
        }

        return response()->json(['message' => 'Item added to cart']);
    }

    public function updateCartItem(Request $request, $id)
    {
        $user = $request->user();
        $quantity = $request->input('quantity');

        // Find the cart item for the user
        $cartItem = Cart::where('user_id', $user->id)->find($id);

        if ($cartItem) {
            // Update the quantity of the cart item
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return response()->json(['message' => 'Cart item updated']);
        }

        return response()->json(['error' => 'Cart item not found'], 404);
    }

    public function removeCartItem(Request $request, $id)
    {
        $user = $request->user();

        // Find and delete the cart item for the user
        $cartItem = Cart::where('user_id', $user->id)->find($id);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Cart item removed']);
        }

        return response()->json(['error' => 'Cart item not found'], 404);
    }
}
