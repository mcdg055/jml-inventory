<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassOutItems extends Model
{
    use HasFactory;

    protected $table = "pass_out_items";

    protected $fillable = [
        'item_id',
        'pass_out_id',
        'quantity',
    ];


    public function pass_out(): BelongsTo
    {
        return $this->belongsTo(PassOut::class);
    }

    public function inventory_item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }
}
