<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
   }

    public function index()
    {
        $permissions = Permission::get();
        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    public function create()
    {
       
    }

    public function store(Request $request)
    {
      
       
    }

    public function edit(Permission $permission)
    {

    }

    public function update(Request $request, Permission $permission)
    {
    
    }

    public function destroy($permissionId)
    {
       
    }
}