<?php

namespace App\Http\Controllers\User;

use Mail;
use File;
use App\User;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Auth::user()->posts;
        return view('user.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('user.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image',
            'summary' => 'required',
            'tag' => 'required',
            'category_id' => 'required',
            'post_status' => 'required',
            'checkbox'=> 'required',
            'source_title' => ' ',
            'source_link' => ' ',
        ],
        [
            'title.required' => 'You need enter the title',
            'summary.required' => 'You need enter the sumary',
            'tag.required' => 'You should add some tags',
            'content.required' => 'You need enter the content',
            'image.required' => 'You have not added an image of the post',
            'checkbox.required' => 'To submit, you need to click on the confirm button',
        ]);
        
        $image = null; 

        if ($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('posts', $image, 'public');
        };
         

        $post = new Post();
        $post->title = $data['title'];
        $post->user_id = Auth::id();
        $post->content = $data['content'];

        $post->image = $image;

        $post->summary = $data['summary'];
        $post->tag = $data['tag'];
        $post->category_id = $data['category_id'];
        $post->post_status = $data['post_status'];
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('l jS \\of F Y h:i:s A');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $post->created_at = now();

        $post->source_title = $data['source_title'];
        $post->source_link = $data['source_link'];

        $post ->save();

        $title_mail = "New post from USER".' '.$now;
        $data = array("title_mail"=>$title_mail,"body"=>'Send mail','email'=>'trunghq9599@gmail.com'); //body of mail.blade.php
        Mail::send('user.mail.mailtoAdmin', ['data'=>$data] , function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });   

        return back()->with('success', 'Create post completed, Please wait for the administrator to approve ^^');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('user.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('user.post.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image',
            'summary' => 'required',
            'tag' => 'required',
            'category_id' => 'required',
            'post_status' => 'required',
            'source_title' => ' ',
            'source_link' => ' ',
        ],
        [
            'title.required' => 'You need enter the title',
            'summary.required' => 'You need enter the sumary',
            'tag.required' => 'You should add some tags',
            'content.required' => 'You need enter the content',
        ]);
        // $post = Post::find($id);
        $image = $post->image;

        if ($request->hasFile('image')){
            if ($image){
                Storage::delete('/public/posts/'. $image);
            }
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('posts', $image, 'public');
        };

        $post->title = $data['title'];
        $post->user_id = Auth::id();
        $post->content = $data['content'];
        
        $post->image = $image;

        $post->summary = $data['summary'];
        $post->tag = $data['tag'];
        $post->category_id = $data['category_id'];
        $post->post_status = $data['post_status'];
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('l jS \\of F Y h:i:s A');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $post->updated_at = now();

        $post->source_title = $data['source_title'];
        $post->source_link = $data['source_link'];

        $post ->save();
        
        return back()->with('success', 'Update post completed ^^');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete('/public/posts/'. $post->image); 
        $post->delete();
        return back()->with('success', 'Delete post completed ^^');
    }
}
