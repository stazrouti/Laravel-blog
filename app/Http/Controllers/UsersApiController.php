<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;


class UsersApiController extends Controller
{
    //
    public function index()
    {
        try {
            $users = User::all()->map(function ($user) {
                $formattedUser = $user->toArray();
                $formattedUser['created_at'] = $user->created_at->format('d-m-Y');
                
                // Check if email_verified_at is not null before formatting
                if ($user->email_verified_at) {
                    $formattedUser['email_verified_at'] = $user->email_verified_at->format('d-m-Y');
                } else {
                    $formattedUser['email_verified_at'] = null; // Handle null case
                }
                
                return $formattedUser;
            });
    
            return response()->json($users);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return response()->json(['error' => 'An error occurred while processing the request'], 500);
        }
    }
    
    public function Delete(Request $request, $id)
    {
        $user = User::find($id);
        try{
            if($user)
            {
                USer::destroy($id);
                
                return response()->json(['message' => 'user deleted successfully'], 200);
            } 
            else {
                return response()->json(['message' => 'user not found.'], 400);
            }
        }
            catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the category'], 500);
        }
    }

    public function Update(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Add other rules for additional fields
        ]);
    
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
    
            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update
            return response()->json(['error' => 'An error occurred while updating the user'], 500);
        }
    }
    
}
