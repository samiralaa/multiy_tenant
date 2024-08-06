<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example data
        $stores = [
        [
          'name'=>'Store 1',
          'domain'=>'a.localhost:8000',
        ],
        [
          'name'=>'Store 2',
          'domain'=>'b.localhost:8000',
        ],
        [
          'name'=>'Store 3',
          'domain'=>'c.localhost:8000',
        ],
        [
          'name'=>'Store 4',
          'domain'=>'d.localhost:8000',
        ],
        [
          'name'=>'Store 5',
          'domain'=>'e.localhost:8000',
        ],
        [
          'name'=>'Store 6',
          'domain'=>'f.localhost:8000',
        ],
        [
          'name'=>'Store 7',
          'domain'=>'g.localhost:8000',
        ],
        [
          'name'=>'Store 8',
          'domain'=>'h.localhost:8000',
        ],
        [
          'name'=>'Store 9',
          'domain'=>'i.localhost:8000',
        ],
        [
          'name'=>'Store 10',
          'domain'=>'j.localhost:8000',
        ],
        [
          'name'=>'Store 11',
          'domain'=>'k.localhost:8000',
        ],
        [
          'name'=>'Store 12',
          'domain'=>'l.localhost:8000',
        ],
        [
          'name'=>'Store 13',
          'domain'=>'m.localhost:8000',
        ],
        [
          'name'=>'Store 14',
          'domain'=>'n.localhost:8000',
        ],
        [
          'name'=>'Store 15',
          'domain'=>'o.localhost:8000',
        ],
        ];

        // Seed stores
        foreach ($stores as $storeData) {
            \App\Models\Store::create([
                'name' => $storeData['name'],
                'domain' => $storeData['domain'],
            ]);
        }
    }
}
