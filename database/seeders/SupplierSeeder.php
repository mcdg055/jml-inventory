<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Database\Factories\SupplierFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::factory()->create([
            'name' => 'Winterfell',
            'contact_person' => 'Ned Stark',
            'contact_number' => '09612345678',
            'is_active' => true,
        ]);
        Supplier::factory()->create([
            'name' => 'Dorn',
            'contact_person' => 'Oberyn Martell',
            'contact_number' => '09123456789',
            'is_active' => true,
        ]);
        Supplier::factory()->create([
            'name' => 'Kings Landing',
            'contact_person' => 'Robert Baratheon',
            'contact_number' => '+63987654321',
            'is_active' => true,
        ]);

       Supplier::factory(10)->create();
    }
}
