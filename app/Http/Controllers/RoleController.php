<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->latest()->get();

        return view('role.role_list', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('role.create_role', compact('permissions'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'          => ['required','string','max:255', 'unique:roles,name'],
                'permissions'   => ['required','array','min:1'],
                'permissions.*' => ['exists:permissions,id']
            ],
            [
                'name.required'        => 'Role name is required.',
                'name.unique'          => 'Role name already exists.',
                'permissions.required' => 'At least one permission is required.',
                'permissions.*.exists' => 'Invalid permission selected.'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }

            $role = Role::create(['name' => Str::slug($request->name, '-'), 'guard_name' => 'web']);

            if($role){
                $permissions = $request->input('permissions');

                // Debugging: Fetch the permissions to see if they exist
                $existingPermissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();

                if (count($permissions) !== count($existingPermissions)) {
                    // If the counts are different, it means some permissions do not exist
                    return redirect()->back()->with('error', 'Invalid permission selected');
                }


                $role->syncPermissions($existingPermissions);

                DB::commit();
                return redirect()->back()->with('message', 'Role created successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function getPermissions($id)
    {
        $role = Role::findOrFail($id); // Fetch the role by ID
        $permissions = $role->permissions; // Fetch associated permissions

        return response()->json($permissions);
    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::with('permissions')->find($id);
        $data = $role->permissions()->pluck('id')->toArray();

        return view('role.edit_role', compact('role', 'permissions', 'data'));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $roleId = $request->input('role_id');

            $validator = Validator::make($request->all(), [
                'name'          => ['required','string','max:255', 'unique:roles,name,'.$roleId],
                'permissions'   => ['required','array','min:1'],
                'permissions.*' => ['exists:permissions,id']
            ],
            [
                'name.required'        => 'Role name is required.',
                'name.unique'          => 'Role name already exists.',
                'permissions.required' => 'At least one permission is required.',
                'permissions.*.exists' => 'Invalid permission selected.'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }

            $role = Role::find($roleId);

            $role->update(['name' => Str::slug($request->name, '-')]);

            $permissions = $request->input('permissions');

            // Debugging: Fetch the permissions to see if they exist
            $existingPermissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();

            if (count($permissions) !== count($existingPermissions)) {
                // If the counts are different, it means some permissions do not exist
                return redirect()->back()->with('error', 'Invalid permission selected');
            }

            $res = $role->syncPermissions($existingPermissions);

            DB::commit();
            if($res){
                session()->flash('message', 'Role update successfully');
                return back();
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $role = Role::find($id);

            if (!$role) {
                return response()->json(['message' => 'Role not found.'], 404);
            }

            $res = $role->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Role deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

}