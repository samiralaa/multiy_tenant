<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example data
        $categories = [
            [
                'name' => 'Electronics',
                'store_id' => 1, // Replace with actual store_id
            ],
            [
                'name' => 'Clothing',
                'store_id' => 2, // Replace with actual store_id
            ],
            [
                'name' => 'Grocery',
                'store_id' => 3, // Replace with actual store_id
            ],
            [
                'name' => 'Pets',
                'store_id' => 4, // Replace with actual store_id
            ],
            [
                'name' => 'Toys',
                'store_id' => 5, // Replace with actual store_id
            ],
            [
                'name' => 'Books',
                'store_id' => 6, // Replace with actual store_id
            ],
            [
                'name' => 'Music',
                'store_id' => 7, // Replace with actual store_id
            ],
            [
                'name' => 'Sports',
                'store_id' => 8, // Replace with actual store_id    
            ],
            [
                'name' => 'Home Decor',
                'store_id' => 9, // Replace with actual store_id
            ],
            [
                'name' => 'Furniture',
                'store_id' => 10, // Replace with actual store_id
            ],
            [
                'name' => 'Books',
                'store_id' => 11, // Replace with actual store_id   
            ],
        ];

        // Seed categories
        foreach ($categories as $categoryData) {
            // Assuming store_id is valid and exists in the stores table
            $store = \App\Models\Store::find($categoryData['store_id']);

            if ($store) {
                \App\Models\Category::create([
                    'name' => $categoryData['name'],
                    'store_id' => $categoryData['store_id'],
                ]);
            }
        }
    }
}
