<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class CandidateProjects extends Model
{
    protected $table = 'ri_candidate_projects';

    protected $fillable = array('client', 'project_title', 'employment_status',
        'duration_years_from', 'duration_months_from',
        'duration_years_to', 'duration_months_to', 'project_location', 'project_details', 'skills',
        'role_description', 'role', 'team_size',
        'created_at', 'modified_at', 'created_by', 'updated_by');

    protected $guarded = array('id', 'candidate_id');

    public function candidateuser()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
