<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\AdminUserService\AdminUserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    private $adminUserService;
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('manage_user'), only:['index']),
//            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create_user'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('update_user'), only:['update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete_user'), only:['delete']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('update_user'), only:['edit']),
        ];
    }

    public function index()
    {
        $users = $this->adminUserService->getAllUsers();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:8|max:20',
                'roles' => 'required'
            ];
            $messages = [
                'name.required'=> 'User name is required.',
                'name.max' => 'User name must not exceed than 255 characters.',
                'email.required'=> 'E-mail is required.',
                'email.email'=> 'Please enter valid e-mail.',
                'email.max'=> 'E-mail must not exceed than 255 characters.',
                'password.required' => 'Password is required.',
                'password.min'=> 'Password must be minimum of 8 characters.',
                'password.max' => 'Password must not exceed more than 20 characters.',
                'roles.required'=> 'Role is required.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => '1'
            ];

            $user = $this->adminUserService->addUser($data);

            // All current roles will be removed from the user and replaced by the array given

            $user->syncRoles($request->roles);

            $notification = array(
                'msg' => 'User created successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.users.index')->with($notification);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','An error occurred. Try Again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->adminUserService->findUserById($id);
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();
            return view('backend.users.show', compact('user', 'roles' ,'userRole'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'An error occurred. Try Again!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $roles = Role::pluck('name','name')->all();
            $user = $this->adminUserService->findUserById($id);
            $userRole = $user->roles->pluck('name','name')->all();

            return view('backend.users.edit', compact('user', 'roles', 'userRole'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'An error occurred. Try Again!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $rules = [
                'name' => 'required|max:255',
                /*'email' => 'required|email|max:255',*/
                'password' => 'nullable|min:8|max:20',
                'roles' => 'required'
            ];

            $messages = [
                'name.required'=> 'User name is required.',
                'name.max'=> 'User name must not be exceed more than 255 characters.',
                /*'email.required'=> 'E-mail is required.',
                'email.email'=> 'Please enter valid e-mail.',
                'email.max'=> 'E-mail must not be exceed more than 255 characters.',*/
                'password.min'=> 'Password must be minimum of 8 characters.',
                'password.max' => 'Password must be maximum of 20 characters.',
                'roles.required' => 'Role is required.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }

            $data = [
                'name' => $request->name,
                /*'email' => $request->email,*/
                'status' => '1'
            ];

            if(!is_null($request->password)) {
                $data['password'] = Hash::make($request->password);
            }

            $user = $this->adminUserService->updateUser($data, $id);

            // lets find user
            $user = $this->adminUserService->findUserById($id);

            // All current roles will be removed from the user and replaced by the array given
            $user->syncRoles($request->roles);

            $notification = array(
                'msg' => 'User with role updated successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.users.index')->with($notification);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'An error occurred. Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->adminUserService->deleteUser($id);
    }
}
