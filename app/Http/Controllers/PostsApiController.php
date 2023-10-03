<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\categories;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage; // <= importer Storage
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class PostsApiController extends Controller
{
    //get all post 
    public function index()
    {
        $posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
        ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        ->select('posts.id','posts.title','posts.likes','posts.picture','posts.created_at', 'categories.name as category_name', Comment::raw('COUNT(comments.id) as comment_count'))
        ->groupBy('posts.id','posts.title','posts.likes','posts.picture','posts.created_at', 'categories.name')
        ->get();
    
    

        // Log the retrieved data
        //Log::info('Retrieved data', ['data' => $posts]);
        return response()->json($posts);
    }
    
}
