<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Comment;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        $comments = Auth::user()->comments;
        return view('user.comment.comment',compact('posts', 'comments'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Delete comment completed ^^');

    }
}
