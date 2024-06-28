<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderFunds extends Model
{
    protected $fillable = [
        'provider_id',
        'provider_change_date',
        'provider_old_funds',
        'provider_new_funds',
        'provider_new_funds_comment'
    ];

    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }
}
