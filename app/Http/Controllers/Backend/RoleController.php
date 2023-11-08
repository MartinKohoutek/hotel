<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

    public function Export() {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request) {
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = [
            'alert-type' => 'success',
            'message' => 'Permission Imported Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function AllRoles() {
        $roles = Role::latest()->get();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }
    
    public function AddRoles() {
        return view('backend.pages.roles.add_roles');
    }

    public function StoreRoles(Request $request) {
        Role::create([
            'name' => $request->name,
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Role Created Successfully!',
        ];

        return redirect()->route('all.roles')->with($notification);
    }
}
