<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class CandidateJobProfile extends Model
{
    protected $table = 'ri_candidate_job_profile';

    protected $fillable = array('profile_name', 'profile_details', 'current_salary', 'expected_salary', 'job_title',
        'skills', 'total_experience_years', 'total_experience_months', 'current_location', 'preferred_location',
        'resume', 'created_at', 'modified_at', 'created_by', 'updated_by');

    protected $guarded = array('id', 'candidate_id');

    public function candidateuser()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
