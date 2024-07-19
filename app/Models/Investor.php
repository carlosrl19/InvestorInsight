<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = [
        'investor_name',
        'investor_company_name',
        'investor_dni',
        'investor_phone',
        'investor_reference_id',
        'investor_balance',
        'investor_status',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_investor')
                    ->withPivot('investor_investment', 'investor_profit')
                    ->withTimestamps();
    }
    
    public function credit_note()
    {
        return $this->hasMany(CreditNote::class, 'investor_id')
                    ->onDelete('cascade');
    }

    public function investor_funds()
    {
        return $this->hasMany(InvestorFunds::class, 'investor_id');
    }

    public function investor_liquidations()
    {
        return $this->hasMany(InvestorLiquidations::class, 'investor_id')
                    ->onDelete('cascade');
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class)
                    ->onDelete('cascade');
    }

    public function payment_investors()
    {
        return $this->hasMany(PaymentInvestor::class);
    }
}