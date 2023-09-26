<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    public function viewCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        return response()->json(['cart' => $cart]);
    }

    public function addToCart(Request $request)
    {
        $bookId = $request->input('book_id');
        $book = Book::find($bookId);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $quantity = $request->input('quantity', 1);

        // Retrieve the current cart from the session
        $cart = $request->session()->get('cart', []);

        // Add the item to the cart or update the quantity if it already exists
        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] += $quantity;
        } else {
            $cart[$bookId] = [
                'book_id' => $bookId,
                'quantity' => $quantity,
                'price' => $book->price,
            ];
        }

        // Store the updated cart back in the session
        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Item added to cart']);
    }

    public function updateCartItem(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        // Retrieve the current cart from the session
        $cart = $request->session()->get('cart', []);

        // Update the quantity of the item in the cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
        }

        // Store the updated cart back in the session
        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Cart item updated']);
    }

    public function removeCartItem(Request $request, $id)
    {
        // Retrieve the current cart from the session
        $cart = $request->session()->get('cart', []);

        // Remove the item from the cart
        unset($cart[$id]);

        // Store the updated cart back in the session
        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Cart item removed']);
    }
}
