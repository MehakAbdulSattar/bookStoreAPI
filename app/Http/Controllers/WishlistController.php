<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class WishlistController extends Controller
{

    public function addToWishlist($bookId)
    {
        $user = Auth::user();
        $wishlistItem = Wishlist::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->first();

        if (!$wishlistItem) 
        {
            Wishlist::create([
                'user_id' => $user->id,
                'book_id' => $bookId,
            ]);

            return response()->json(['message' => 'Item added to wishlist'], Response::HTTP_CREATED);
        }

        return response()->json(['message' => 'Item is already in the wishlist'], Response::HTTP_CONFLICT);
    }


    public function removeFromWishlist($bookId)
    {
        $user = Auth::user();
        $wishlistItem = Wishlist::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->first();

        if ($wishlistItem) 
        {
            $wishlistItem->delete();

            return response()->json(['message' => 'Item removed from wishlist'], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Item not found in the wishlist'], Response::HTTP_NOT_FOUND);
    }

    public function getUserWishlist()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlist;

        return response()->json(['wishlist' => $wishlistItems], Response::HTTP_OK);
    }
}

