<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Categories;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage; // <= importer Storage
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;


class PostsApiController extends Controller
{
    //get all post 
    public function index()
    {
        $posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
        ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        ->select('posts.id','posts.title','posts.likes','posts.picture','posts.created_at','posts.content', 'categories.name as category_name', Comment::raw('COUNT(comments.id) as comment_count'))
        ->groupBy('posts.id','posts.title','posts.likes','posts.picture','posts.created_at','posts.content', 'categories.name')
        ->get();
    
    

        // Log the retrieved data
        //Log::info('Retrieved data', ['data' => $posts]);
        return response()->json($posts);
    }
    //create new post

    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'picture' => 'required|url',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Validate each category_id in the array
        ]);

        // Create a new Post instance and save it to the database
        $post = new Post;
        $post->title = $validatedData['title'];
        $post->picture = $validatedData['picture'];
        $post->content = $validatedData['content'];
        
        // Assuming 'category_id' is an array of category IDs, you can store them as a JSON array
        $post->category_id = json_encode($validatedData['category_id']);
        
        $post->save();

        // Optionally, you can return a response, e.g., a success message or a redirect
        return response()->json(['message' => 'Post created successfully'], 201);
    }
    //get post data

    public function getPost(Request $request, $id)
    {
        // Example: Retrieve the post with the "category" relationship and comments
        $post = Post::with('category', 'comments.user')->find($id);
        $comments = Comment::with('user')->get();
    
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    
        // Format the "created_at" and "updated_at" timestamps for the post
        $formattedCreatedAt = Carbon::parse($post->created_at)->format('Y-m-d H:i:s');
        $formattedUpdatedAt = Carbon::parse($post->updated_at)->format('Y-m-d H:i:s');
    
        // Create an array with the desired format for comments
        $formattedComments = $post->comments->map(function ($comment) {
            $formattedCommentCreatedAt = Carbon::parse($comment->created_at)->format('Y-m-d H:i:s');
            $formattedCommentUpdatedAt = Carbon::parse($comment->updated_at)->format('Y-m-d H:i:s');
    
            // Retrieve the username of the user who made the comment
            //$username = $comment->user->username;
            $username = $comment->user->name;
    
            return [
                'id' => $comment->id,
                'user_id' => $comment->user_id,
                'post_id' => $comment->post_id,
                'body' => $comment->body,
                'created_at' => $formattedCommentCreatedAt,
                'updated_at' => $formattedCommentUpdatedAt,
                'username' => $username, // Include the username

            ];
        });
    
        // Create an array with the desired format for the post
        $formattedPost = [
            'id' => $post->id,
            'title' => $post->title,
            'picture' => $post->picture,
            'category' => $post->category->name,
            'content' => $post->content,
            'likes' => $post->likes,
            'created_at' => $formattedCreatedAt,
            'updated_at' => $formattedUpdatedAt,
            'comments' => $formattedComments->toArray(), // Include formatted comments for the post
        ];
    
        // Return the response with the manually formatted post data
        return response()->json($formattedPost);
    }
    public function DeletePost(Request $request, $id)
    {
        try {
            // Attempt to delete the post
            Post::destroy($id);
    
            // Return a success response
            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the post'], 500);
        }
    }
    public function UpdatePost(Request $request, $id) {
        $post = Post::findOrFail($id);
        
        // Retrieve the category ID based on the category name from the request
        $category = Categories::where('name', $request->category)->first();
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Define validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required',
        ];
    
        // Validate the request data
        $this->validate($request, $rules);
    
        // Handle the picture URL (if provided)
        if ($request->has('picture_url')) {
            // You can save the picture URL directly to the 'picture' field
            $post->update([
                'title' => $request->title,
                'picture' => $request->picture_url,
                'content' => $request->content,
                'category_id' => $category->id,
            ]);
        } else {
            // Handle the picture upload as before (if a new picture file is provided)
            if ($request->hasFile('picture')) {
                // Delete the old picture if it exists
                if ($post->picture) {
                    Storage::delete($post->picture);
                }
    
                // Store the new picture and get its path
                $picturePath = $request->file('picture')->store('posts');
            }
    
            // Update the post data including the picture (if provided)
            $post->update([
                'title' => $request->title,
                'picture' => isset($picturePath) ? $picturePath : $post->picture,
                'content' => $request->content,
                'category_id' => $category->id,
            ]);
        }
    
        // Return a JSON response with a success message and the updated post data
        return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
    }
    public function DeleteComment(Request $request, $id) {
    
        $comment = comment::find($id);
        try{
            if($comment)
            {
                comment::destroy($id);
                
                return response()->json(['message' => 'comment deleted successfully'], 200);
            } 
            else {
                return response()->json(['message' => 'comment has associated posts. Cannot delete.'], 400);
            }
        }
            catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            return response()->json(['error' => 'An error occurred while deleting the category'], 500);
        }

    
    }
    
    
    

    
    
        
}
