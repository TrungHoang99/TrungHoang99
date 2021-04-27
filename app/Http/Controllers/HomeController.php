<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        // $posts = Post::latest()->take(4)->get();
        $posts = Post::orderBy('id', 'DESC')->approved()->take(4)->get();
        return view('welcome', compact('categories', 'posts'));
    }

    public function category(Category $category)
    {
        // return view('pages.category', compact('category'));
    }

    
}
