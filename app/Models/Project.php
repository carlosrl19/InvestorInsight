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
        'investor_id',
        'investor_investment',
        'investor_profit',
        'commissioner_id',
        'commissioner_profit',
        'project_description',
    ];

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }
    
}
