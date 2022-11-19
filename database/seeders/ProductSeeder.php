<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Config;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $faker = Faker::create();
        foreach (range(1, 100) as $value) {
            Product::create([
                'name' => $faker->randomElement(Brand::pluck('name')) . ' Watch',
                'price' => $faker->numberBetween($min = 5000, $max = 100000),
                'sale_price' => $faker->numberBetween($min = 500, $max = 4999),
                'color' => $faker->randomElement(['Gold', 'Rose Gold', 'Silver', 'Black', 'Beige', 'Blue', 'Green']),
                'brand_id' => $faker->randomElement(Brand::pluck('id')),
                'product_code' => $faker->numerify('LV-#####'),
                'gender' => $faker->randomElement(['male', 'female', 'children', 'unisex']),
                'function' => $faker->randomElement(Config::get('watch_functions')),
                'stock' => $faker->randomDigit(),
                'description' => $faker->text($maxNbChars = 200),
                'image' => $faker->imageUrl($width = 640, $height = 480),
                'is_active' => $faker->randomElement(['1', '0']),
            ]);
        }
    }
}
