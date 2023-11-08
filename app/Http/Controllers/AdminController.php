<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use function Ramsey\Uuid\v1;

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

        $notification = [
            'alert-type' => 'success',
            'message' => 'Admin Profile Updated Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword() {
        $admin = User::findOrFail(Auth::user()->id);
        return view('admin.admin_change_password', compact('admin'));
    }

    public function AdminPasswordUpdate(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Old Password Doesn\'t Match!',
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

    public function AllAdmin() {
        $admins = User::where('role', 'admin')->get();
        return view('backend.pages.admin.all_admin', compact('admins'));
    }

    public function AddAdmin() {
        $roles = Role::all();
        return view('backend.pages.admin.add_admin', compact('roles'));
    }

    public function StoreAdmin(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = [
            'alert-type' => 'success',
            'message' => 'New Admin Account Created Successfully!',
        ];

        return redirect()->route('all.admin')->with($notification);
    }
}
