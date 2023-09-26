<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        $this->authorize('update', $user);
        return response()->json(['message' => 'Profile updated']);
    }

    public function show()
    {
        $user = auth()->user(); // Get the authenticated user
        $this->authorize('show', $user);

        // Return the user's profile as a JSON response
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        // Delete the user's profile (admin only)

        return response()->json(['message' => 'Profile deleted']);
    }
}

