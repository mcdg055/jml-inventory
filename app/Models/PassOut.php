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
    ];

    public function items() : HasMany
    {
        return $this->hasMany(PassOutItems::class);
    }
}
