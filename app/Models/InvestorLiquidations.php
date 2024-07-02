<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorLiquidations extends Model
{
    protected $fillable = [
        'investor_id',
        'investor_liquidation_amount',
        'investor_liquidation_date',
    ];

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }
}
