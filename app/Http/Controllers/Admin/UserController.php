<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::users()
            ->withCount('posts')
            ->withCount('comments')
            ->get();
        return view('adminstrator.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();
        $posts = $user->posts();
        dd($posts);
        // return back()->with('success', 'Delete user completed ^^');
    }
}
