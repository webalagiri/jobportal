<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class ListGroup extends Model
{
    protected $table = 'ri_list_group';

    public function listentities()
    {
        return $this->hasMany('App\jobportal\model\entities\ListEntity', 'list_group_id');
    }

}
