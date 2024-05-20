<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_code',
        'project_name',
        'project_estimated_time',
        'project_start_date',
        'project_end_date',
        'project_investment',
        'project_total_worked_days',
        'project_status',
        'investor_id',
        'investor_investment',
        'investor_profit_perc',
        'project_description',
    ];

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }
    
}
