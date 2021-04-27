<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->paginate(5);
        return view('adminstrator.category.index')->with(compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminstrator.category.create');
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
            'image' => 'required|image',
            'category_status' => 'required'
        ],
        [
            'title.required' => 'You need enter the title',
            'category_status.required' => 'You need choose the status',
        ]
        );
        $image = null; 

        if ($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('categories', $image, 'public');
        };


        $category = new Category();
        $category->title = $data['title'];

        $category->image = $image;

        $category->category_status = $data['category_status'];
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('l jS \\of F Y h:i:s A');
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $category->created_at = now();
        $category->save();
        
        return back()->with('success', 'Create category completed ^^');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('adminstrator.category.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
            'category_status' => 'required'
        ],
        [
            'title.required' => 'You need enter the title',
            'category_status.required' => 'You need choose the status',
        ]
        );

        $category = Category::find($id);
        $image = $category->image;

        if ($request->hasFile('image')){
            if ($image){
                Storage::delete('/public/categories/'. $image);
            }

            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('categories', $image, 'public');
        };

        $category->title = $data['title'];

        $category->image = $image;

        $category->category_status = $data['category_status'];
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('l jS \\of F Y h:i:s A');
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $category->updated_at = now();
        $category->save();
        
        return back()->with('success', 'Update category completed ^^');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        Storage::delete('/public/categories/'. $category->image);
        $category->delete();
        return back()->with('success', 'Delete category complted :))');
    }
}
