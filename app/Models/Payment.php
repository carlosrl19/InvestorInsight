<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_code',
        'payment_amount',
        'payment_date',
        'promissoryNote_id',
    ];

    public function investors()
    {
        return $this->hasMany(Investor::class);
    }
    
    public function commissioners()
    {
        return $this->hasMany(CommissionAgent::class);
    }

    public function promissory_note_investors()
    {
        return $this->hasMany(PromissoryNote::class);
    }
    
    public function promissory_note_commissioners()
    {
        return $this->hasMany(PromissoryNoteCommissioner::class);
    }

}
