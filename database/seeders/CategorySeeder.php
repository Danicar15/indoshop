<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'موبایل', 'slug' => 'mobile'],
            ['name' => 'لپ‌تاپ', 'slug' => 'laptop'],
            ['name' => 'هدفون و هندزفری', 'slug' => 'headphones'],
            ['name' => 'تجهیزات صوتی', 'slug' => 'audio'],
            ['name' => 'ساعت هوشمند', 'slug' => 'smart-watch'],
            ['name' => 'لوازم جانبی', 'slug' => 'accessories'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
