<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supply extends Model
{
    use HasFactory;

    protected $table = 'supplies';

    protected $fillable = [
        'supplier_id',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(InventoryItem::class, 'supplies_supply_items')->withPivot('unit_price', 'quantity');
    }

    public function getNumberAttribute()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
