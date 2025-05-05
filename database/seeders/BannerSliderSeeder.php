<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSliderSeeder extends Seeder
{
    public function run()
    {
        DB::table('banner_sliders')->insert([
            [
                'id' => 1,
                'title' => 'Special Offer',
                'sub_title' => 'Get 50% off on your first order',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'image' => '/uploads/media_650a8acf27d2a.jpg',
                'button_text' => 'Order Now',
                'button_link' => '/menu',
                'status' => 1,
                'created_at' => '2023-09-20 00:01:51',
                'updated_at' => '2023-09-20 00:02:46'
            ],
            [
                'id' => 2,
                'title' => 'New Menu Items',
                'sub_title' => 'Try our new delicious dishes',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'image' => '/uploads/media_650a8acf27d2b.jpg',
                'button_text' => 'View Menu',
                'button_link' => '/menu',
                'status' => 1,
                'created_at' => '2023-09-20 00:01:51',
                'updated_at' => '2023-09-20 00:02:46'
            ]
        ]);
    }
} 