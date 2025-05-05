<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run()
    {
        DB::table('abouts')->insert([
            'id' => 1,
            'image' => '/uploads/media_650a8acf27d2a.jpg',
            'title' => 'About Company',
            'main_title' => 'Helathy Foods Provider',
            'description' => '<div class="fp__about_us_text">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate aspernatur molestiae
                            minima pariatur consequatur voluptate sapiente deleniti soluta, animi ab necessitatibus
                            optio similique quasi fuga impedit corrupti obcaecati neque consequatur sequi.</p>
                        <ul><li>Delicious & Healthy Foods </li><li>Spacific Family & Kids Zone</li><li>Best Price & Offers</li><li>Made By Fresh Ingredients</li><li>Music & Other Facilities</li><li>Delicious & Healthy Foods </li><li>Spacific Family & Kids Zone</li><li>Best Price & Offers</li><li>Made By Fresh Ingredients</li><li>Delicious & Healthy Foods </li></ul>
                    </div><p></p>',
            'video_link' => 'https://www.youtube.com/watch?v=WSTf9Bja7is',
            'created_at' => '2023-09-20 00:01:51',
            'updated_at' => '2023-09-20 00:02:46'
        ]);
    }
} 