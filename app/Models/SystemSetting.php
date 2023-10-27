<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $guarded = [];

    public function logo(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value
                ? config('app.admin_url').'/storage/'.$value
                : config('app.admin_url').'/images/no_image.jpeg'
        );
    }
}
