<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Resources\RoleResource;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $role = Role::orderBy('id','asc')->get();
        return response()->json([
            RoleResource::collection($role)
        ]);
    }

    public function show($id, Request $request)
    {
        $role = Role::with(['permissions'])->find($id);
        // dd($role->toArray());
        
        $userData = $request->toArray();

        return response()->json(RoleResource::make($role));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission_ids' => 'required',
        ]);
        
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        $permissions = Permission::whereIn('id', $request->permission_ids)->get();

        // dd($request);
        $role->syncPermissions($permissions);
    
        return response()->json(RoleResource::make($role));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission_ids' => 'required',
        ]);

        $userData = $request->toArray();
    
        $role = Role::where('id', $request->id)->first();
        $permissions = Permission::whereIn('id', $request->permission_ids)->get();
        $role->syncPermissions($request->input('permission_ids'));

        return response()->json(RoleResource::make($role));
    }    

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

}
