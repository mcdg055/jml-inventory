<?php

namespace App\Models;

use App\Http\Traits\WithSelect;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryItem extends Model
{
    use HasFactory;
    use WithSelect;

    protected $table = 'inventory_items';

    protected $fillable = [
        'name',
        'brand_id',
        'unit_price',
        'stock',
        'critical_level',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'number',
        'name_with_brand',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function getNumberAttribute()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getNameWithBrandAttribute()
    {
        return $this->brand->name . " " . $this->name;
    }

}
