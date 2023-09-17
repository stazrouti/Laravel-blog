<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;



class CommentController extends Controller
{
    // Create a new comment
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'body' => 'required|max:255',
    ]);

    if (auth()->check()) {
        $data = [
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'body' => $request->body,
        ];

        // Create the comment with the user's ID
        Comment::create($data);

        return back()->with('success', 'Comment added successfully.');
        // Redirect or do other actions...
    } else {
        // Handle the case when there is no authenticated user.
        return back()->with('warning', 'You need to sign in to leave a comment.');
    }
}

    public function destroy(Comment $comment)
    {
        // Authorize the deletion (e.g., only allow the user who created the comment to delete it)
        //$this->authorize('destroy', $comment);

        // Delete the comment
        //dd($comment);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }

}
