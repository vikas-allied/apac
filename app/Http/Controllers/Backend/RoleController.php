<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\PermissionService\PermissionService;
use App\Services\RoleService\RoleService;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $roleService, $permissionService;
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }


    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'role_name'=> 'required|unique:roles,name',
            ];
            $messages = [
                'role_name.required'=> 'Role name is required',
                'role_name.unique'=> 'Role name must be unique',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }

            $data = [
                'name' => slugify($request->role_name),
            ];

            $this->roleService->addRole($data);

            $notification = array(
                'msg' => 'Role added successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.roles.index')->with($notification);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','An error occurred. Try Again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('backend.role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('backend.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            $rules = [
                'role_name'=> 'required|unique:roles,name,'.$role->id,
            ];
            $messages = [
                'role_name.required'=> 'Role name is required.',
                'role_name.unique'=> 'Role name is already used. Please enter another role name.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }

            $this->roleService->updateRole(['name' => slugify($request->role_name)], $role->id);
            $notification = array(
                'msg' => 'Role updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.roles.index')->with($notification);

        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','An error occurred. Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addPermissionToRole($roleId) {
        try {
            $permissions = $this->permissionService->getAllPermissions();
            $role = $this->roleService->findRoleById($roleId);
            $rolePermissions = $this->roleService->getAllPermissionByRole($roleId);

            return view('backend.role.add_permission', compact('role', 'permissions', 'rolePermissions'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'An error occurred. Try Again!');
        }
    }

    public function givePermissionToRole(Request $request, $roleId) {
        try {
            $rules = [
                'permission'=> 'required',
            ];
            $messages = [
                'permission.required' => 'Permission is required.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }
            $role = Role::findById($roleId);
            $role->syncPermissions($request->permission);

            $notification = array(
                'msg' => 'Permission added to role.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'An error occurred. Try Again!');
        }
    }
}
