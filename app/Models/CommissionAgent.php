<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionAgent extends Model
{
    protected $fillable = [
        'commissioner_code',
        'commissioner_name',
        'commissioner_dni',
        'commissioner_phone',
        'commissioner_balance',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_commissioner', 'commissioner_id', 'project_id')
                    ->withPivot('commissioner_commission')
                    ->withTimestamps();
    }
}
