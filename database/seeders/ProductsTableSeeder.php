<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example data
        $products = [
            [
                'name' => 'Smartphone',
                'price' => 999.99,
                'category_id' => 1,
                'store_id' => 1, 
            ],
            [
                'name' => 'T-Shirt',
                'price' => 29.99,
                'category_id' => 2, 
                'store_id' => 2,

            ],
            [
                'name' => 'Grocery Item',
                'price' => 3.99,
                'category_id' => 3, 
                'store_id' => 3,
            ],
            [
                'name' => 'Dog Toy',
                'price' => 19.99,
                'category_id' => 4,
                'store_id' => 4,
            ],
            [
                'name' => 'Laptop',
                'price' => 1299.99,
                'category_id' => 5,
                'store_id' => 5,
            ],
            [
                'name' => 'Book',
                'price' => 9.99,
                'category_id' => 6,
                'store_id' => 6,
            ],
            [
                'name' => 'CD',
                'price' => 4.99,
                'category_id' => 7,
                'store_id' => 7,
            ],
            [
                'name' => 'Table',
                'price' => 399.99,
                'category_id' => 8,
                'store_id' => 8,
            ],
            [
                'name' => 'Chair',
                'price' => 79.99,
                'category_id' => 9,
                'store_id' => 9,
            ],
            [
                'name' => 'Cup',
                'price' => 1.99,
                'category_id' => 10,
                'store_id' => 10,
            ],
            [
                'name' => 'Book',
                'price' => 9.99,
                'category_id' => 11,
                'store_id' => 11,
            ]
        ];

        // Seed products
        foreach ($products as $productData) {
            // Assuming category_id is valid and exists in the categories table
            $category = \App\Models\Category::find($productData['category_id']);
            if ($category) {
                \App\Models\Product::create([
                    'name' => $productData['name'],
                    'price' => $productData['price'],
                    'store_id' => $productData['store_id'],
                    'category_id' => $productData['category_id'],
                ]);
            }
        }
    }
}
