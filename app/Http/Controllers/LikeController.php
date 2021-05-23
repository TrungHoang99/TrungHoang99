<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function add($post)
    {
        $user = Auth::user();
        $isLike = $user->likedPosts()->where('post_id', $post)->count();

        if ($isLike == 0)
        {
            $user->likedPosts()->attach($post);
            
        }
        else {
            $user->likedPosts()->detach($post);
            
        }
        return redirect()->back();
    }
}
