<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class CandidatePersonalProfile extends Model
{
    protected $table = 'ri_candidate_personal_profile';

    protected $fillable = array('first_name', 'last_name', 'email', 'phone', 'mobile', 'location',
        'address', 'city', 'country', 'pincode', 'gender', 'date_of_birth', 'marital_status',
        'physically_challenged', 'photo',
        'created_at', 'modified_at', 'created_by', 'updated_by');

    protected $guarded = array('id', 'candidate_id');

    public function candidateuser()
    {
        return $this->belongsTo('App\User', 'candidate_id');
    }
}
