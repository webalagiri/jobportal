<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class CandidateEmployment extends Model
{
    protected $table = 'ri_candidate_employment';

    protected $fillable = array('company_name', 'designation', 'experience_years',
        'experience_months', 'employment_status', 'duration_from_years', 'duration_from_months',
        'duration_to_years', 'duration_to_months', 'annual_salary', 'notice_period',
        'created_at', 'modified_at', 'created_by', 'updated_by');

    protected $guarded = array('id', 'candidate_id');

    public function candidateuser()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
