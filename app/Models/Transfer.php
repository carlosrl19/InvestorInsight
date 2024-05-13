<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'transfers';

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }

    protected $fillable = [
        'transfer_code',
        'transfer_bank',
        'investor_id',
        'transfer_amount',
        'transfer_date',
        'transfer_description',
    ];
}
