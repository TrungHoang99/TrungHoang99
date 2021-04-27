<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;

class CommentReplyController extends Controller
{
    public function store(Request $request,Comment $comment)
    {
        $data = $request->validate([
            'reply' => 'required'
        ]);
 
        $reply = new CommentReply();
        $reply->comment_id = $comment->id;
        $reply->user_id = Auth::id();
        $reply->reply = $data['reply'];
        $reply->save();
        
        return redirect()->back();
    }

    public function destroy($id)
    {
        $reply = CommentReply::findOrFail($id);
        $reply->delete();
        return redirect()->back()->with('success', 'Delete reply completed ^^');

    }
}
