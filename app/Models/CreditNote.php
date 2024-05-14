<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }
    
    protected $fillable = [
        'creditNote_date',
        'investor_id',
        'creditNote_amount',
        'creditNote_description',
    ];
}
