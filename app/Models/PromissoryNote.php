<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromissoryNote extends Model
{
    protected $fillable = [
        'investor_id',
        'promissoryNote_emission_date',
        'promissoryNote_final_date',
        'promissoryNote_amount',
        'promissoryNote_code',
        'promissoryNote_status',
    ];

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'promissoryNote_code', 'project_code');
    }

}
