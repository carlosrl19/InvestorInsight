<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromissoryNoteCommissioner extends Model
{
    protected $fillable = [
        'commissioner_id',
        'promissoryNoteCommissioner_emission_date',
        'promissoryNoteCommissioner_final_date',
        'promissoryNoteCommissioner_amount',
        'promissoryNoteCommissioner_code',
        'promissoryNoteCommissioner_status',
    ];

    public function commissioner(){
        return $this->belongsTo(CommissionAgent::class, 'commissioner_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'promissoryNoteCommissioner_code', 'project_code');
    }
}
