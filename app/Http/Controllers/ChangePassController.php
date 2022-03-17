<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    public function CPassword()
    {
        return view('admin.body.change_password');
    }
    public function UpdatePassword(Request $request)
    {
        $validation = $request->validate([
            'oldpassword'=>'required',
            'password' =>'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','password change successfuly');
        }else{
            return redirect()->back()->with('error','current password is invalid');
        }
    }
    public function PUpdate()
    {
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }
    public function UpdateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
         if($user){
             $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            return redirect()->back()->with('success', 'user profile updated successfuly');

         }
        return redirect()->back();

    }
}
