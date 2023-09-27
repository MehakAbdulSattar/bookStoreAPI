<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $user=auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            // Define your validation rules here for updating user data
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required|string|min:6',
        ]);
        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully']);
       
    }

    public function show()
    {
        $user = auth()->user(); // Get the authenticated user
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
      
    }

    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        // Delete the user's profile (admin only)
        $user->delete();
        return response()->json(['message' => 'Profile deleted']);
    }
    
    public function subscription()
    {
        $user = auth()->user(); 
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->subscription)
        {
            return response()->json(['error' => 'User has already Newsletter Subscription'], 201);

        }

        $user->subscription=true;
        $user->save();
        return response()->json(['Successful' => 'User has Successfully availed Newsletter Subscription'], 201);
    }
}