<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title','LIKE',"%$query%")->Orwhere('summary','LIKE',"%$query%")->get();
        return view('pages.search',compact('posts','query'));
    }
}
