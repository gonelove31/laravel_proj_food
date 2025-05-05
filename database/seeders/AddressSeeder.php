<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'delivery_area_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'address' => '123 Main St',
                'type' => 'home',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'delivery_area_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane@example.com',
                'phone' => '0987654321',
                'address' => '456 Oak Ave',
                'type' => 'office',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 