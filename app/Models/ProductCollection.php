<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCollection extends Model
{
    protected $guarded = [];

    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }
}
