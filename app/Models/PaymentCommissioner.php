<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCommissioner extends Model
{
    protected $fillable = [
        'payment_code',
        'payment_amount',
        'payment_date',
        'promissoryNote_id',
        'commissioner_id',
    ];
    
    public function commissioner()
    {
        return $this->belongsTo(CommissionAgent::class, 'commissioner_id');
    }

    public function promissoryNoteCommissioner()
    {
        return $this->belongsTo(PromissoryNoteCommissioner::class, 'promissoryNoteCommissioner_id');
    }
}
