<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromissoryNote extends Model
{
    protected $fillable = [
        'investor_id',
        'promissoryNote_emission_date',
        'promissoryNote_final_date',
        'promissoryNote_amount',
        'promissoryNote_code',
    ];
}
