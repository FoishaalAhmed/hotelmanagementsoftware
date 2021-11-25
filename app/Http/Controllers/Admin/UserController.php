<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use DB;

class UserController extends Controller
{

    protected Object $userObject;

    public function __construct()
    {
        $this->userObject = new User;
    }

    public function index()
    {
        $users = User::where('hotel_id', auth()->user()->hotel_id)->get();
        return view('backend.admin.user.index', compact('users'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('backend.admin.user.create', compact('permissions'));
    }

    public function store(UserRequest $request)
    {
        $this->userObject->storeUser($request);
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $permissions = Permission::orderBy('name', 'asc')->get();
        $userPermission = DB::table('model_has_permissions')->where('model_id', $id)->pluck('permission_id')->toArray();
        return view('backend.admin.user.edit', compact('user', 'permissions', 'userPermission'));
    }

    public function update(UserRequest $request,  $id)
    {
        $this->userObject->updateUser($request, $id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->userObject->destroyUser($id);
        return redirect()->back();
    }
}
