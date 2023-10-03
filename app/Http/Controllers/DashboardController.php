<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Comment;
use App\Models\PostLikes;

class DashboardController extends Controller
{
    //get dashbord element and analytic
    public function index()  {
        $TotalPosts = post::count();
        $TotalComment = Comment::count();
        $TotalLikes = post::sum('likes');
        $ResponseData =[ 
            "TotalPosts" => $TotalPosts,
            "TotalComment" => $TotalComment,
            "TotalLikes" => $TotalLikes,
        ];
        $A="hello";
        return  response()->json($ResponseData);
    }
}
