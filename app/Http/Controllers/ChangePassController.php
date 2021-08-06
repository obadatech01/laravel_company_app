<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    public function ChangePassword()
    {
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $validate = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Current Password Is Invalid');
        }
    }

    public function EditProfile()
    {
        if(Auth::user()) {
            $user = User::find(Auth::user()->id);
            if($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            return redirect()->back()->with('success', 'User Profile Is Updated Successfully');
        } else {
            return redirect()->back();
        }
    }
}
