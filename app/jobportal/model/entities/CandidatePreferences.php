<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class CandidatePreferences extends Model
{
    protected $table = 'ri_candidate_preferences';

    protected $fillable = array('job_type', 'employment_type', 'industry',
        'recommended_companies', 'dream_companies',
        'preferred_skills', 'companies_interviewed_with', 'preferred_roles',
        'created_at', 'modified_at', 'created_by', 'updated_by');

    protected $guarded = array('id', 'candidate_id');

    public function candidateuser()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
