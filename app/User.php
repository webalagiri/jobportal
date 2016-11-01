<?php

namespace App;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

//class User extends Authenticatable
class User extends Model implements AuthenticatableContract,
    //AuthorizableContract,
    CanResetPasswordContract
{
    protected $table = 'users';

    use Authenticatable;
    //use Authorizable;
    use CanResetPassword;
    use EntrustUserTrait;
    //use HasRoles;
    //use Authenticatable, Authorizable, CanResetPassword, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
        return $this->hasOne('App\jobportal\model\entities\Company', 'company_id');
    }

    public function jobprofiles()
    {
        return $this->hasMany('App\jobportal\model\entities\JobProfile', 'company_id');
    }

    public function candidatepersonalprofile()
    {
        return $this->hasOne('App\jobportal\model\entities\CandidatePersonalProfile', 'candidate_id');
    }

    public function candidatejobprofile()
    {
        return $this->hasOne('App\jobportal\model\entities\CandidateJobProfile', 'candidate_id');
    }

    public function candidateskills()
    {
        return $this->hasOne('App\jobportal\model\entities\CandidateSkills', 'candidate_id');
    }

    public function candidateemployment()
    {
        return $this->hasOne('App\jobportal\model\entities\CandidateEmployment', 'candidate_id');
    }

    public function candidateprojects()
    {
        return $this->hasOne('App\jobportal\model\entities\CandidateProjects', 'candidate_id');
    }

    public function candidatepreferences()
    {
        return $this->hasOne('App\jobportal\model\entities\CandidatePreferences', 'candidate_id');
    }

    public function candidateapplyjobs()
    {
        return $this->hasMany('App\jobportal\model\entities\CandidateApplyJob', 'candidate_id');
    }
}
