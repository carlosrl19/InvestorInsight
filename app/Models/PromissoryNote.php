<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromissoryNote extends Model
{
    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }

    protected $fillable = [
        'investor_id',
        'promissoryNote_emission_date',
        'promissoryNote_final_date',
        'promissoryNote_amount',
        'promissoryNote_code',
        'promissoryNote_status',
    ];
}
