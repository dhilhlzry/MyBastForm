<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RoleRepository implements IRoleRepository
{
  public function StoreRole(array $data)
  {
    $guard_name = "web";
    $role = Role::create([
      'name' => $data['name'],
      'slug' => Str::slug($data['name']),
      'guard_name' => 'web'

    ]);
    foreach ($data['permission'] as $key => $value) {
      Permission::updateOrCreate(['name' => $value, 'guard_name' => 'web']);
    }
    $role->syncPermissions($data['permission']);
  }
  public function DeleteRole($id)
  {
    $role = Role::where('id', $id)->first();
    $role->delete();
  }
  public function UpdateRole(array $data, $id)
  {
    // dd($data);
    $find = Role::find($id);
    $find->update([
      'name' => $data['name'],
      'slug' => Str::slug($data['name'])
    ]);
    foreach ($data['permission'] as $key => $value) {
      Permission::updateOrCreate(['name' => $value, 'guard_name' => 'web']);
    }
    $find->syncPermissions($data['permission']);
  }
}
