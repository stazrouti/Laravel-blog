<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\Post;



class CategoriesApiController extends Controller
{
    //
    public function index()
    {
        $categories=categories::get();

        return response()->json($categories);
    }
    public function store(Request $request) {
        // Validate the incoming data
        $validatedData = $request->validate([
            'categoryName' => 'required|string|max:255',
            'categoryDescription' => 'required|string',
        ]);
        // Create a new Post instance and save it to the database
        $category=new categories ;

        $category->name=$validatedData['categoryName'];
        $category->description=$validatedData['categoryDescription'];

        $category->save();

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category, // Assuming $category holds the newly created category
        ], 200);
        

    }
    public function delete(Request $request, $id)
    {
        //$category = posts::find($id);
        $posts = Post::where('category_id', $id)->get();
        try {
            if ($posts->isEmpty()) {
                categories::destroy($id);
                return response()->json(['message' => 'Category deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Category has associated posts. Cannot delete.'], 400);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the category'], 500);
        }
    

       /*  if ($posts->isEmpty()) {
            return response()->json(['message' => 'Category has  not posts'],400);
        } else {
            return response()->json(['message' => 'Category has posts exists'], 400);
        }

        try {
            if ($category->posts()->count() > 0) {
                return response()->json(['message' => 'Category has associated posts. Cannot delete.'], 400);
            }
            // Attempt to delete the post
            //categories::destroy($id);
    
            // Return a success response
            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the post'], 500);
        } */
    }
    public function Update(Request $request, $id)
    {
        try {
            // Find the category by its ID
            $category = categories::find($id);
    
            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }
    
            // Validate the incoming data
            $validatedData = $request->validate([
                'Name' => 'required|string|max:255',
                'Description' => 'required|string',
            ]);
    
            // Update the category's name and description
            $category->name = $validatedData['Name'];
            $category->description = $validatedData['Description'];
    
            $category->save();
    
            // Return the updated category
            return response()->json(['message' => 'Category updated successfully', 'data' => $category], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update
            return response()->json(['error' => 'An error occurred while updating the category'], 500);
        }
    }
}
