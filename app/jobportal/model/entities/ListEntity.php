<?php

namespace App\jobportal\model\entities;

use Illuminate\Database\Eloquent\Model;

class ListEntity extends Model
{
    protected $table = 'ri_list_entities';

    public function listgroup()
    {
        return $this->belongsTo('App\jobportal\model\entities\ListGroup', 'list_group_id');
    }
}
