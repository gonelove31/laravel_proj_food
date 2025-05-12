<?php

namespace Database\Seeders;

use App\Models\SectionTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyChooseUsTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectionTitle::insert([
            [
                'key' => 'why_choose_top_title',
                'value' => 'why choose us'
            ],
            [
                'key' => 'why_choose_main_title',
                'value' => 'why choose us'
            ],
            [
                'key' => 'why_choose_sub_title',
                'value' => 'Chúng tôi mang đến món ăn nóng hổi, chuẩn vị, giao hàng nhanh chóng và dịch vụ thân thiện. Nguyên liệu tươi mỗi ngày, thực đơn đa dạng, giá cả hợp lý – tất cả vì trải nghiệm ẩm thực tuyệt vời của bạn!'
            ]

        ]);
    }
}
