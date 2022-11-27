<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryItem::factory()->create([
            'name' => 'Sketch Pad',
            'brand_id' => 1,
            'unit_price' => 31,
            'stock' => 15,
            'critical_level' => 10,
        ]);
        InventoryItem::factory()->create([
            'name' => 'Scented Paper 10pcs',
            'brand_id' => 2,
            'unit_price' => 45,
            'stock' => 50,
            'critical_level' => 10,
        ]);
        InventoryItem::factory()->create([
            'name' => 'Photo Paper 10pcs',
            'brand_id' => 3,
            'unit_price' => 44,
            'stock' => 50,
            'critical_level' => 10,
        ]);

        InventoryItem::factory()->create([
            'name' => 'Craft Paper 1 Bundle 20 pcs',
            'brand_id' => 9,
            'unit_price' => 44,
            'stock' => 5,
            'is_active' => false,
            'critical_level' => 10,
        ]);
    }
}