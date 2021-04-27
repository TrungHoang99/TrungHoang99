<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($name)
    {
        $user = User::where('name', $name)->first();
        $posts = $user->posts()->approved()->get();
        return view('pages.user', compact('user', 'posts'));
    }
}
