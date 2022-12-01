<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassOut extends Model
{
    use HasFactory;

    const INACTIVE = 0;
    const ACTIVE = 1;

    protected $table = "pass_outs";

    protected $fillable = [
        'name',
        'notes',
        'status',
    ];

    protected $visible = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',

        'name',
        'notes',
        'status',
        'number',
        'total_items',
        'total',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'total'=>'float',
    ];
    protected $appends = [
        'number',
        'total_items',
        'total',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PassOutItem::class);
    }

    public function getNumberAttribute()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('subtotal');
    }

    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }
}
