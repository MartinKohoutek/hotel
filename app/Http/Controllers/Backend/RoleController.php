<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Exports\RolesExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Imports\RolesImport;
use App\Models\User;
use DB;
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

        return redirect()->route('all.permission')->with($notification);
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

    public function EditRoles($id) {
        $role = Role::find($id);
        return view('backend.pages.roles.edit_roles', compact('role'));
    }

    public function UpdateRoles(Request $request) {
        $role = Role::find($request->id);
        $role->update([
            'name' => $request->name,
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Role Updated Successfully!',
        ];

        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id) {
        Role::find($id)->delete();

        $notification = [
            'alert-type' => 'success',
            'message' => 'Role Deleted Successfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function ExportRoles() {
        return Excel::download(new RolesExport, 'roles.xlsx');
    }

    public function ImportRolesView() {
        return view('backend.pages.roles.import_roles');
    }

    public function ImportRolesStore(Request $request) {
        Excel::import(new RolesImport, $request->file('import_roles'));

        $notification = [
            'alert-type' => 'success',
            'message' => 'Roles Imported Successfully!',
        ];

        return redirect()->route('all.roles')->with($notification);
    }

    public function AddRolesPermission() {
        $permissions = Permission::latest()->get();
        $roles = Role::latest()->get();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.setup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function RolePermissionStore(Request $request) {
        $data = [];
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = [
            'alert-type' => 'success',
            'message' => 'Roles in Permission Added Successfully!',
        ];

        return redirect()->back()->with($notification);
    }
}
