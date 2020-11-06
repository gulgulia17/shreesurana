<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permissions.index', ['permission' => Permission::all(), 'role' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Permission::create($this->validateRequest($request));
        return redirect(route('permission.index'))->with('success', 'Permission Created Successfully.');
    }

    public function give(Request $request)
    {
        if (isset($request->role) && !empty($request->role)) {
            $role = Role::findById($request->roles);
            $permission = Permission::findById($request->permission);
            $role->givePermissionTo($permission);
            return response('message', 200);
        } else {
            $role = Role::findById($request->roles);
            $permission = Permission::findById($request->permission);
            $role->revokePermissionTo($permission);
            return response(['message' => 'Permission revoken Successfully'], 200);
        }
    }

    public function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required|unique:permissions',
            'guard_name' => 'required',
        ]);
    }
}
