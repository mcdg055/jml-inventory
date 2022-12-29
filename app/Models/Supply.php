<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $appends = [
        'number',
        'total_items',
        'total',
    ];

    /**
     * Supplier of the supply
     *
     * @return BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Person/User who received the supply
     *
     * @return BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /**
     * just a pivot table for the supply items and inventory items
     *
     * @return BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(InventoryItem::class, 'supplies_supply_items')->withPivot('id', 'unit_price', 'quantity');
    }

    /**
     * the supply items
     *
     * @return HasMany|Collection
     */
    public function supply_items(): HasMany
    {
        return $this->hasMany(SupplyItem::class);
    }

    /**
     * the id of the supply
     *
     * @return int
     */
    public function getNumberAttribute()
    {
        return str_pad($this->id, 8, '0', STR_PAD_LEFT);
    }

    /**
     * ge the total number of items a supply has
     *
     * @return int
     */
    public function getTotalItemsAttribute()
    {
        return $this->supply_items()->sum('quantity');
    }

    /**
     * get the total cost of a supply
     *
     * @return string|float
     */
    public function getTotalAttribute()
    {
        $items = $this->supply_items()->select('unit_price', 'quantity')->get();

        $total = $items->reduce(function($total, $item){
            return $total + ($item->quantity * $item->unit_price);
        });

        return "₱ ".number_format((float)$total, 2, '.', '');
    }
}
