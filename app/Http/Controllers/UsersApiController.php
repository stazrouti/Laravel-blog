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
        
        try{

            //$users=user::get();
            $users = User::all()->map(function ($user) {
                $formattedUser = $user->toArray();
                $formattedUser['created_at'] = $user->created_at->format('d-m-y');
                return $formattedUser;
            });  
            
            return response()->json($users);

        }
            catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the category'], 500);
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
}
