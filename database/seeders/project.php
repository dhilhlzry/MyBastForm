<?php

namespace Database\Seeders;

use App\Models\project as ModelsProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class project extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsProject::create([
			'name' => 'form',
			'description' => 'description 1',
			'assign_to' => '1'
        ]);
        }
    }

