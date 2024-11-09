<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StoresTableSeeder::class,
            // CategoriesTableSeeder::class,
            // ProductsTableSeeder::class,
            // Add more seeders if needed
        ]);

        User::factory(80)->create();
    }
}
