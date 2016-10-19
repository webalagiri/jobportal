<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class CandidateSkills extends Model
{
    protected $table = 'ri_candidate_skills';

    protected $fillable = array('skill_name', 'skill_version', 'last_used', 'experience_years',
        'experience_months', 'created_at', 'modified_at', 'created_by', 'updated_by');

    protected $guarded = array('id', 'candidate_id');

    public function candidateuser()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
