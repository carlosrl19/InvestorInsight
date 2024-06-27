<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        "provider_name",
        "provider_dni",
        "provider_phone",
        "provider_description",
        "provider_balance",
    ];
}
