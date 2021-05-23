<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Comment;
use Session;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function details($id){
        $post = Post::find($id);

        $blogKey = 'blog_' . $post->id;

        if (!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
        $comments = $post->comments();
        
        $category = Category::all();
        $related = Post::where('category_id',$post->category_id)->whereNotIn('id', [$id])->approved()->take(3)->get();
        return view('pages.post', compact('post', 'category', 'comments', 'related'));
    }

    public function postByCategory($title)
    {
        $category = Category::where('title',$title)->first();
        $posts = $category->posts()->approved()->paginate(10);
        $lastedposts = $category->posts()->approved()->latest()->take(3)->get();
        $categories = Category::all();
        return view('pages.category',compact('categories', 'category', 'lastedposts', 'posts'));
    }
}
