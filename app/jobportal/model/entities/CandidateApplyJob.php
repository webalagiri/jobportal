<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class CandidateApplyJob extends Model
{
    protected $table = 'ri_candidate_apply_job';

    protected $guarded = array('id', 'candidate_id', 'company_id', 'job_id');

    public function candidateuser()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
