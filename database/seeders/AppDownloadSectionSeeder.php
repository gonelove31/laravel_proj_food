<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppDownloadSectionSeeder extends Seeder
{
    public function run()
    {
        DB::table('app_download_sections')->insert([
            [
                'id' => 1,
                'title' => 'Download Our Mobile App',
                'sub_title' => 'Get 40% off on your first order',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'play_store_link' => 'https://play.google.com/store/apps',
                'app_store_link' => 'https://apps.apple.com/app',
                'image' => '/uploads/media_650a8acf27d2a.jpg',
                'created_at' => '2023-09-20 00:01:51',
                'updated_at' => '2023-09-20 00:02:46'
            ]
        ]);
    }
} 