<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }

    public function investors()
    {
        return $this->belongsToMany(Investor::class, 'project_investor')
            ->withPivot('investor_final_profit')
            ->withTimestamps();
    }


    protected $fillable = [
        'creditNote_date',
        'investor_id',
        'creditNote_amount',
        'creditNote_code',
        'creditNote_description',
    ];
}
