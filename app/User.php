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
}
