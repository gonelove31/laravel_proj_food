<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenuItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_menu_items')->insert([
            [
                'id' => 1,
                'admin_menu_id' => 1,
                'parent_id' => null,
                'title' => 'Home',
                'url' => '/',
                'target' => '_self',
                'icon_class' => 'fas fa-home',
                'order' => 1,
                'created_at' => '2023-09-13 05:31:22',
                'updated_at' => '2023-09-13 05:31:22'
            ],
            [
                'id' => 2,
                'admin_menu_id' => 1,
                'parent_id' => null,
                'title' => 'About',
                'url' => '/about',
                'target' => '_self',
                'icon_class' => 'fas fa-info-circle',
                'order' => 2,
                'created_at' => '2023-09-13 05:31:22',
                'updated_at' => '2023-09-13 05:31:22'
            ],
            [
                'id' => 3,
                'admin_menu_id' => 1,
                'parent_id' => null,
                'title' => 'Contact',
                'url' => '/contact',
                'target' => '_self',
                'icon_class' => 'fas fa-envelope',
                'order' => 3,
                'created_at' => '2023-09-13 05:31:22',
                'updated_at' => '2023-09-13 05:31:22'
            ]
        ]);
    }
} 