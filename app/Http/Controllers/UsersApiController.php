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

            $users=user::get();
            return response()->json($users);

        }
            catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the category'], 500);
        }
    }
}
