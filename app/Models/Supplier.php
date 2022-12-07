<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'contact_number',
        'contact_person',
        'is_active',
    ];

    public function supplies() : HasMany
    {
        return $this->hasMany(Supplies::class);
    }
}
