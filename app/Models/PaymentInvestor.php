<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInvestor extends Model
{
    protected $fillable = [
        'payment_code',
        'payment_amount',
        'payment_date',
        'promissoryNote_id',
        'investor_id',
        'project_id',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }

    public function promissoryNoteInvestor()
    {
        return $this->belongsTo(PromissoryNote::class, 'promissoryNote_id');
    }

    public function project()
    {
        return $this->investor->belongsToMany(Project::class, 'project_investor')
            ->withPivot('investor_investment', 'investor_profit', 'investor_final_profit');
    }
}
