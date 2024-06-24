<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorFunds extends Model
{
    protected $fillable = [
        'investor_id',
        'investor_change_date',
        'investor_old_funds',
        'investor_new_funds',
        'investor_new_funds_comment'
    ];

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }
}
