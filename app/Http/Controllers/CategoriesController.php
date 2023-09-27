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
        $orderValue = $request->input('OrderValue', 'created_at'); // Default to 'Date' if not provided
        if($request->input('OrderValue'))
        {

            $orderValue = $request->input('OrderValue', 'likes'); // Default to 'Date' if not provided
        }
        // Retrieve posts with the same category_id
        $posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('category_id', $id)
            ->orderBy($orderValue, 'desc')
            ->paginate(10);
    
        // Get the category name
        $categoryName = $category->name;
        $id = $category->id;
    
        return view("posts.index", compact("categoryName", "posts","id"));
    }
    
    

}
