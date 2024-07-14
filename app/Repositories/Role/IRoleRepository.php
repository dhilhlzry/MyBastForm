<?php

namespace App\Repositories\Role;

interface IRoleRepository
{
  public function StoreRole(array $data);
  public function DeleteRole($id);
  public function UpdateRole(array $data,$id);
}
