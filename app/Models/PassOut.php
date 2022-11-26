<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassOut extends Model
{
    use HasFactory;

    const PASS_OUT_STATUS_DRAFT = 0;
    const PASS_OUT_STATUS_COMPLETED = 0;

    protected $table = "pass_outs";

    protected $fillable = [
        'short_description',
        'notes',
        'status',
    ];

    protected $visible = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',

        'short_description',
        'notes',
        'status',
        'number',
        'subtotal',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    protected $appends = [
        'number',
        'subtotal',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PassOutItem::class);
    }

    public function getNumberAttribute()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getSubtotalAttribute()
    {
        return "₱ " . $this->items->sum('subtotal');
    }
}
