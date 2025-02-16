<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RollController extends Controller
{
    public function role_manage(){
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('admin.role.index',compact('permissions','roles','users'));
    }

    public function permission_store(Request $request){
         Permission::create(['name' => $request->permission_name]);
         return back();
    }

    public function role_store(Request $request){
        $role = Role::create(['name' => $request->roll_name]);
        $role->givePermissionTo($request->permission);
        return back();
    }

    public function role_delete($id){
        $roles = Role::find($id);
        DB::table('role_has_permissions')->where('role_id',$id)->delete();
        Role::find($id)->delete();
        return back();
    }

    public function role_edit($id){
        $permissions = Permission::all();
        $role = Role::find($id);
        return view('admin.role.role_edit',compact('permissions','role'));
    }

    public function role_update(Request $request, $id){
        $role = Role::find($id);
        $role->syncPermissions($request->permission);
        return redirect()->route('roll.manage');
    }

    public function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role);
        return back();
    }

    public function remove_role($id){
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        return back();
     }

}
