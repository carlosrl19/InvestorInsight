<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCommissioner extends Model
{
    protected $fillable = [
        'payment_code',
        'payment_amount',
        'payment_date',
        'promissoryNoteCommissioner_id',
    ];
    
    public function commissioners()
    {
        return $this->belongsTo(CommissionAgent::class);
    }

    public function promissoryNoteCommissioner()
    {
        return $this->belongsTo(PromissoryNoteCommissioner::class, 'promissoryNoteCommissioner_id');
    }
}
