<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\Comment;
use App\Models\PostLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <= importer Storage
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //make poste by order
        $orderValue = $request->input('OrderValue', 'created_at'); // Default to 'Date' if not provided
        //select all posts
        /* $posts = Post::latest()->get(); */
        $posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('posts.*', 'categories.name as category_name',)
        ->orderBy($orderValue, 'desc')
        ->paginate(10); // Specify the number of items per page (e.g., 10)
        //dd($posts);
        // Customize the pagination settings
        //$posts->withPath('/custom-path'); // Customize the URL path
        $posts->onEachSide(2); // Customize the number of links on each side of the current page
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.edit");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. La validation
        $this->validate($request, [
            'title' => 'bail|required|string|max:255',
            "picture" => 'bail|required|image|max:1024',
            "content" => 'bail|required',
        ]);

        // 2. On upload l'image dans "/storage/app/public/posts"
        $chemin_image = $request->picture->store("posts");

        // 3. On enregistre les informations du Post
        Post::create([
            "title" => $request->title,
            "picture" => $chemin_image,
            "content" => $request->content,
        ]);

        // 4. On retourne vers tous les posts : route("posts.index")
        return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        // Retrieve the comments associated with the post

        $comments = Comment::join('users','comments.user_id','=','users.id')
        ->select('comments.*','comments.id as cmid','users.name as name')
        ->where('post_id', $post->id)
        ->get();
        // Check if the current user has liked the post
        $userLiked = PostLikes::where('post_id', $post->id)
        ->where('user_id', Auth::id())
        ->exists();
        
        return view("posts.show", compact("post", "comments","userLiked"));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        //
        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        // 1. La validation

        // Les règles de validation pour "title" et "content"
        $rules = [
            'title' => 'bail|required|string|max:255',
            "content" => 'bail|required',
        ];

        // Si une nouvelle image est envoyée
        if ($request->has("picture")) {
            // On ajoute la règle de validation pour "picture"
            $rules["picture"] = 'bail|required|image|max:1024';
        }

        $this->validate($request, $rules);

        // 2. On upload l'image dans "/storage/app/public/posts"
        if ($request->has("picture")) {

            //On supprime l'ancienne image
            Storage::delete($post->picture);

            $chemin_image = $request->picture->store("posts");
        }

        // 3. On met à jour les informations du Post
        $post->update([
            "title" => $request->title,
            "picture" => isset($chemin_image) ? $chemin_image : $post->picture,
            "content" => $request->content
        ]);

        // 4. On affiche le Post modifié : route("posts.show")
        return redirect(route("posts.show", $post));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        /// On supprime l'image existant
        Storage::delete($post->picture);

        // On les informations du $post de la table "posts"
        $post->delete();

        // Redirection route "posts.index"
        return redirect(route('posts.index'));
    }
    //make  an update to increment the like number
    public function UpdateLike(Request $request, $id)
    {
        $post = Post::find($id);
    
        // Check if the user has already liked the post.
        $postLike = PostLikes::where('user_id', $request->user()->id)->where('post_id', $id)->first();
    
        if ($postLike === null) {
            // The user has not already liked the post, so insert a new row into the table.
            PostLikes::create([
                'user_id' => $request->user()->id,
                'post_id' => $id,
            ]);
    
            // Increment the like count of the post.
            $post->increment('likes'); // Assuming 'likes' is the column name in your table.
        } else {
            // The user has already liked the post, so delete the row from the table.
            $postLike->delete();
    
            // Decrement the like count of the post.
            $post->decrement('likes'); // Assuming 'likes' is the column name in your table.
        }
    
        return redirect()->back();
    }
    

}
