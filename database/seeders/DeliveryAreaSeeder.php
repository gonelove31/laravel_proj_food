<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryAreaSeeder extends Seeder
{
    public function run()
    {
        DB::table('delivery_areas')->insert([
            [
                'id' => 1,
                'area_name' => 'Downtown',
                'min_delivery_time' => '30',
                'max_delivery_time' => '45',
                'delivery_fee' => '5.00',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'area_name' => 'Uptown',
                'min_delivery_time' => '45',
                'max_delivery_time' => '60',
                'delivery_fee' => '7.00',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 