<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    public function page(): HasOne
    {
        return $this->hasOne(LandingPage::class);
    }

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value
                ? config('app.admin_url').'/storage/'.$value
                : '/design/no-image.jpg'
        );
    }
}
