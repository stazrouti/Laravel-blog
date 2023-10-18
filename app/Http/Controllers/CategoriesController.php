<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Post;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Storage; // <= importer Storage


class CategoriesController extends Controller
{
    
    // Show posts by category
    public function show($id,Request $request )
    {
        // Retrieve the category by its ID
        $category = categories::findOrFail($id); // Assuming your model is named "Category" (singular)
        
        //make poste by order
        if($request->input('OrderValue')=="Newest")
        {
            $orderValue="created_at";
            $ord='desc';
        }
        elseif($request->input('OrderValue')=="Oldest")
        {
            $orderValue="created_at";
            $ord= "asc";
        }
        elseif($request->input('OrderValue')=="Likes")
        {
            $orderValue="likes";
            $ord='desc';
        }
        else
        {
            $orderValue="created_at";
            $ord='desc';
        }
        // Retrieve posts with the same category_id
        $posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('category_id', $id)
            ->orderBy($orderValue, $ord)
            ->paginate(10);
    
        // Get the category name
        $categoryName = $category->name;
        $id = $category->id;
    
        return view("posts.index", compact("categoryName", "posts","id"));
    }
    
    

}
