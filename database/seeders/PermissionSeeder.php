<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Config::get('permission_list');
        foreach ($permissions as $key => $permission) {
            foreach ($permission['feature'] as $name => $value) {
                $t = Permission::findOrCreate($permission['slug'] . '-' . $name);
            }
        }
    }
}
