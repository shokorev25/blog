<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $post->comments()->create([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $post);
    }

    public function approve(Comment $comment)
    {
        $comment->is_approved = true;
        $comment->save();
        return back();
    }

    public function reject(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
