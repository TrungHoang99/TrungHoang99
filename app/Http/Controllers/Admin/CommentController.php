<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        // $comments = Comment::latest()->paginate(10);
        $comments = Comment::orderBy('id', 'DESC')->paginate(10);
        // $post = Post::orderBy('id', 'DESC')->paginate(2);
        return view('adminstrator.comment.comment',compact('comments'));
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        
        return redirect()->back()->with('success', 'Delete comment completed @@');
    }
}
