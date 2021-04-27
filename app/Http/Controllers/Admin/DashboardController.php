<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Post;
use App\Category;
use App\Comment;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
                            ->orderBy('view_count','desc')
                            ->withCount('comments')
                            ->take(5)->get();
        $total_pending_posts = Post::where('is_approve', false)->count();
        $all_views = Post::sum('view_count');
        $user_count = User::where('role_id',2)->count();
        $new_users_today = User::where('role_id',2)
                                ->whereDate('created_at',Carbon::today())->count();
        $active_users = User::where('role_id',2)
                                ->withCount('posts')
                                ->withCount('comments')
                                ->take(10)->get();
        $category_count = Category::all()->count();

        return view('adminstrator.ddashboard',compact('posts','popular_posts','total_pending_posts','all_views','user_count','new_users_today','active_users','category_count'));
    }
}
