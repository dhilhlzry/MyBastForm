<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Super Admin',
            'Admin',
            'Project Coordinator'
        ];

        foreach ($roles as $key => $value) {
            Role::create([
                'name' => $value,
                'slug' => Str::slug($value),
                'guard_name'=>'web'

            ]);
        }
        $role = Role::find(1);
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
    }
}
