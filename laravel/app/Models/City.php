<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'city',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
