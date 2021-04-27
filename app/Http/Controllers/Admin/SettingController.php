<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        return view('adminstrator.setting.index');
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
            if ($image){
                Storage::delete('/public/profiles/'. $image);
            }
            $image = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('profiles', $image, 'public');
        };

        $user->name = $data['name'];
        $user->job = $request->job;
        $user->address = $request->address;

        $user->image = $image;

        $user->about = $request->about;
        $user->save();

        return back()->with('success', 'Update profile completed ^^');
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
