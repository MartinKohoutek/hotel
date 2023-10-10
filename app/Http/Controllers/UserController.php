<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index() {
        return view('frontend.index');
    }

    public function UserProfile() {
        $user = User::findOrFail(Auth::user()->id);
        return view('frontend.dashboard.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request) {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('/upload/user_images/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('/upload/user_images'), $fileName);
            $data['photo'] = $fileName;
        }
        $data->save();

        $notification = [
            'alert-type' => 'success',
            'message' => 'User Profile Updated Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'alert-type' => 'success',
            'message' => 'User Logout Successfully!',
        ];

        return redirect('/login')->with($notification);
    }

    public function UserChangePassword() {
        return view('frontend.dashboard.user_change_password');
    }

    public function UserPasswordUpdate(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Old Password Does Not Match!'
            ];

            return back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Password Changed Successfully!',
        ];

        return back()->with($notification);
    }
}
