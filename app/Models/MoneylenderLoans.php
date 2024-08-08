<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneylenderLoans extends Model
{
    public function moneylender(){
        return $this->belongsTo(Moneylender::class, 'moneylender_id');
    }

    public function commissioner(){
        return $this->belongsTo(CommissionAgent::class, 'commissioner_id');
    }

    protected $fillable = [
        'loan_code',
        'moneylender_id',
        'commissioner_id',
        'loan_emission_date',
        'loan_first_paydate',
        'loan_amount',
        'loan_tax',
        'loan_quotas',
        'loan_quota_amount',
        'loan_total_amount',
        'loan_description',
    ];
}
