<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_menus')->insert([
            [
                'id' => 1,
                'name' => 'main_menu',
                'created_at' => '2023-09-13 05:31:22',
                'updated_at' => '2023-09-13 05:31:22'
            ],
            [
                'id' => 2,
                'name' => 'footer_menu_one',
                'created_at' => '2023-09-13 05:31:22',
                'updated_at' => '2023-09-13 05:31:22'
            ],
            [
                'id' => 3,
                'name' => 'footer_menu_two',
                'created_at' => '2023-09-13 05:34:53',
                'updated_at' => '2023-09-13 05:34:53'
            ],
            [
                'id' => 4,
                'name' => 'footer_menu_three',
                'created_at' => '2023-09-13 05:35:29',
                'updated_at' => '2023-09-13 05:35:29'
            ]
        ]);
    }
} 