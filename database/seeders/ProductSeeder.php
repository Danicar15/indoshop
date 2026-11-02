<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['category' => 'mobile', 'name' => 'گوشی هوشمند Nova X', 'price' => 18500000, 'stock' => 12, 'description' => 'گوشی هوشمند مناسب استفاده روزمره با طراحی مدرن و عملکرد روان.'],
            ['category' => 'laptop', 'name' => 'لپ‌تاپ AirBook 14', 'price' => 42500000, 'stock' => 5, 'description' => 'لپ‌تاپی سبک برای کار، مطالعه و جابه‌جایی روزانه.'],
            ['category' => 'headphones', 'name' => 'هدفون بی‌سیم Wave Pro', 'price' => 3200000, 'stock' => 18, 'description' => 'هدفون بی‌سیم با طراحی راحت برای موسیقی و تماس.'],
            ['category' => 'audio', 'name' => 'اسپیکر قابل حمل BeatBox', 'price' => 2450000, 'stock' => 9, 'description' => 'اسپیکر جمع‌وجور برای استفاده در خانه و سفر.'],
            ['category' => 'smart-watch', 'name' => 'ساعت هوشمند Fit One', 'price' => 4100000, 'stock' => 14, 'description' => 'ساعت هوشمند با امکانات کاربردی روزانه و طراحی مینیمال.'],
            ['category' => 'accessories', 'name' => 'شارژر سریع 30 وات', 'price' => 690000, 'stock' => 30, 'description' => 'شارژر سریع و کم‌حجم برای دستگاه‌های سازگار.'],
            ['category' => 'headphones', 'name' => 'ایربادز Air Mini', 'price' => 1750000, 'stock' => 0, 'description' => 'ایربادز سبک برای مکالمه و گوش‌دادن به موسیقی.'],
            ['category' => 'accessories', 'name' => 'پاوربانک 20000 میلی‌آمپر', 'price' => 2150000, 'stock' => 7, 'description' => 'پاوربانک قابل حمل برای شارژ دستگاه‌ها در طول روز.'],
        ];

        foreach ($items as $item) {
            $category = Category::where('slug', $item['category'])->first();
            $slug = Str::slug($item['name'], '-', 'fa') ?: 'product-' . md5($item['name']);

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'is_active' => true,
                ]
            );
        }
    }
}
