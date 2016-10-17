<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class JobProfile extends Model
{
    protected $table = 'ri_jobs';

    protected $fillable = array('job_post_name', 'job_description', 'job_post_type', 'job_post_vacancy',
        'job_experience', 'job_salary_min', 'job_salary_max', 'job_skills', 'job_industry_area',
        'job_functional_area', 'job_active_from', 'job_active_to', 'job_status',
        'created_at', 'updated_at', 'created_by', 'updated_by');

    protected $guarded = array('id');

    public function company()
    {
        return $this->belongsTo('App\User', 'company_id');
    }
}
