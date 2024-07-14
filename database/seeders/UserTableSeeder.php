<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
			'name' => 'Superadmin1',
			'email' => env('DEFAULT_EMAIL', 'admin1@admin.com'),
			'password' => Hash::make(env('DEFAULT_PASSWORD', 12345678)),
			'role_id' => 1,
            'nip' => '102107192'
        ]);

        $user->assignRole(1);
    }
}
