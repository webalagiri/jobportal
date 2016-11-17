<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class JobInterview extends Model
{
    protected $table = 'ri_job_interview';

    protected $guarded = array('id');

    public function candidate()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
