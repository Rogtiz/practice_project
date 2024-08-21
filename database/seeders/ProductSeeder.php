<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone',
                'description' => 'A high-end smartphone',
                'price' => 699.99,
                'category_id' => Category::where('name', 'Electronics')->first()->id,
            ],
            [
                'name' => 'Washing Machine',
                'description' => 'An energy-efficient washing machine',
                'price' => 499.99,
                'category_id' => Category::where('name', 'Home Appliances')->first()->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
