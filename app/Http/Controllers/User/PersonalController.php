<?php

namespace App\Http\Controllers\User;

use File;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->approved()->latest()->get();
        $comments = Auth::user()->comments;
        return view('user.setting.index',compact('posts', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeProfile(){
        return view('user.setting.profile');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);
        $user = User::findorFail(Auth::id());
        $image = $user->image;

        if ($request->hasFile('image')){
            // if ($image){
            //     Storage::delete('/public/profiles/'. $image);
            // }
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('profiles', $image, 'public');
        };

        $user->name = $data['name'];
        $user->job = $request->job;
        $user->address = $request->address;

        $user->image = $image;

        $user->about = $request->about;

        $user->social_network = $request->social_network;
        $user->social_network_link = $request->social_network_link;

        $user->save();

        return back()->with('success', 'Update profile completed ^^');
    }

    public function changePassword()
    {
        return view('user.setting.password');
    }

    public function updatePassword (Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password; //hashed
        if (Hash::check($request->old_password, $hashedPassword)){
            // old pass should not be same as new pass   
            if (!Hash::check($request->password, $hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('success', 'Update password completed ^^');
            }
            else {
                return redirect()->back()->with('error', 'New password cannot be the same as old password');
            }
        }
        else {
            return redirect()->back()->with('error', 'Current password not match');
        }
    }
}
