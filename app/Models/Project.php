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
        'project_investment',
        'project_status',
        'project_description',
    ];

    public function investors()
    {
        return $this->belongsToMany(Investor::class, 'project_investor')
                    ->withPivot('investor_investment', 'investor_profit')
                    ->withTimestamps();
    }

    public function commissioners()
    {
        return $this->belongsToMany(CommissionAgent::class, 'project_commissioner', 'project_id', 'commissioner_id')
                    ->withPivot('commissioner_commission')
                    ->withTimestamps();
    }
}