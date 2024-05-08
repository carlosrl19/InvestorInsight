<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'project_estimated_time',
        'project_start_date',
        'project_end_date',
        'project_investment',
        'project_total_worked_days',
        'project_state',
        'inversors_id',
        'inversors_investment_amount',
        'inversors_profit_perc',
    ];
}
