<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::truncate();
        $brands = config('brands');
        foreach($brands as $brand){
            Brand::create([
                'name' => ucfirst($brand['name']),
                'description' => $brand['name'] . ' description',
                'image' => Str::snake($brand['image']),
            ]);
        }
    }
}
