<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromissoryNoteCommissioner extends Model
{
    public function investor(){
        return $this->belongsTo(CommissionAgent::class, 'commissioner_id', 'id');
    }

    protected $fillable = [
        'commissioner_id',
        'promissoryNoteCommissioner_emission_date',
        'promissoryNoteCommissioner_final_date',
        'promissoryNoteCommissioner_amount',
        'promissoryNoteCommissioner_code',
        'promissoryNoteCommissioner_status',
    ];
}
