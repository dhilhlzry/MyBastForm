<?php

namespace App\Services\Role;

use Illuminate\Http\Request;

interface IRoleService
{
  public function StoreRole(Request $data);
  public function DeleteRole($id);
  public function UpdateRole(Request $data,$id);
}
