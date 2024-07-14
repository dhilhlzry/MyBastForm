<?php

namespace App\Services\Role;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Role\IRoleRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RoleService implements IRoleService
{
  public $role;

  public function __construct(IRoleRepository $role)
  {
    $this->role = $role;
  }

  public function StoreRole(Request $request)
  {

    $request->validate([
      'name' => 'required|unique:roles',
    ]);
    if (!$request->has('permission')) {
      throw \Illuminate\Validation\ValidationException::withMessages([
        'permission' => 'You must select at least one option.',
      ]);
    }
   
    return $this->role->StoreRole($request->all());
  }

  public function DeleteRole($id)
  {
    $user = User::where('role_id',$id)->first();
   
    if ($user) {
      throw new Exception("role has been used");
    }
    return $this->role->DeleteRole($id);
  }

  public function UpdateRole(Request $request, $id)
  {
    if (!$request->has('permission')) {
      throw \Illuminate\Validation\ValidationException::withMessages([
        'permission' => 'You must select at least one option.',
      ]);
    }
    $request->validate([
      'name' => 'required',
    ]);
    return $this->role->UpdateRole($request->all(),$id);
  }
}
