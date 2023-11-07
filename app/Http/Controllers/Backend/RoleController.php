<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission() {
        $permissions = Permission::latest()->get();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission() {
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request) {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Permission Created Successfully!',
        ];

        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id) {
        $permission = Permission::find($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    public function UpdatePermission(Request $request) {
        $permission = Permission::find($request->id);
        $permission->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        
        $notification = [
            'alert-type' => 'success',
            'message' => 'Permission Updated Successfully!',
        ];

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id) {
        Permission::find($id)->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Permission Deleted Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function ImportPermission() {
        return view('backend.pages.permission.import_permission');
    }
}
