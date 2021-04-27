<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request,Post $post)
    {
        $data = $request->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->comment = $data['comment'];
        $comment->save();
        
        return redirect()->back();
    }
}
