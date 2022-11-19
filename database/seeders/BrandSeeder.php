<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()->create([
            'name' => 'Sharpie',
        ]);

        Brand::factory()->create([
            'name' => "Scotch",
        ]);

        Brand::factory()->create([
            'name' => "Elmer's Products",
        ]);

        Brand::factory()->create([
            'name' => "ExpoExpo",
        ]);

        Brand::factory()->create([
            'name' => "CrayolaCrayola",
        ]);

        Brand::factory()->create([
            'name' => "Paper MatePaper Mate",
        ]);

        Brand::factory()->create([
            'name' => "Five Star",
        ]);

        Brand::factory()->create([
            'name' => "Pandayan",
        ]);

        Brand::factory()->create([
            'name' => "National Bookstore",
        ]);
    }
}
