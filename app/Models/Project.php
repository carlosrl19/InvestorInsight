<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_code',
        'project_name',
        'project_start_date',
        'project_end_date',
        'project_work_days',
        'project_investment',
        'project_status',
        'project_comment',
        'project_close_comment',
        'project_proof_transfer_img',
        'investor_balance_history'
    ];

    public function investors()
    {
        return $this->belongsToMany(Investor::class, 'project_investor')
            ->withPivot('investor_investment', 'investor_profit', 'investor_final_profit')
            ->withTimestamps();
    }

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }

    public function commissioners()
    {
        return $this->belongsToMany(CommissionAgent::class, 'project_commissioner', 'project_id', 'commissioner_id')
            ->withPivot('commissioner_commission')
            ->withTimestamps();
    }
}