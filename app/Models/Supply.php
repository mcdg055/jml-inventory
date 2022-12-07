<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Supply extends Model
{
    use HasFactory;
    protected $table = 'supplies';

    protected $fillable = [
        'supplier_id',
        'notes',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function receiver() : BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
