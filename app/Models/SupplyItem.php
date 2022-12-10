<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SupplyItem extends Model
{
    use HasFactory;

    protected $table = "supplies_supply_items";

    public function inventory_item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }
}
