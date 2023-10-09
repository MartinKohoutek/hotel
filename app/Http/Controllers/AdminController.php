<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard() {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AdminLogin() {
        return view('admin.admin_login');
    }

    public function AdminProfile() {
        $admin = User::findOrFail(Auth::user()->id);
        return view('admin.admin_profile_view', compact('admin'));
    }

    public function AdminProfileStore(Request $request) {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $img = $request->file('photo');
            @unlink(public_path('/upload/admin_images/').$data->photo);
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move(public_path('upload/admin_images'), $imgName);
            $data['photo'] = $imgName;
        }
        $data->save();
        return redirect()->back();
    }
}
