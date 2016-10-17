<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'ri_company_profile';

    protected $fillable = array('company_name', 'description', 'company_type', 'email', 'phone', 'location',
        'address', 'city', 'country', 'pincode', 'company_logo', 'contact_person', 'contact_person_mobile',
        'created_at', 'modified_at', 'created_by', 'updated_by');

    protected $guarded = array('id', 'company_id');

    public function companyuser()
    {
        return $this->belongsTo('App\User', 'company_id');
    }
}
