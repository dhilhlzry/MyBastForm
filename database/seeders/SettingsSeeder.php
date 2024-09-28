<?php

namespace Database\Seeders;

use App\Models\DocumentSet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = DocumentSet::create([
			'name' => 'document',
			'margin_y' => '3rem',
            'margin_x' => '5rem',
            'col1_mt' => '3rem',
            'col2_mt' => '1rem',
            'col3_mt' => '1rem',
            'col4_mt' => '1rem',
        ]);
    }
}
