<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/11/2016
 * Time: 7:20 PM
 */

namespace App\jobportal\repositories\repointerface;


interface HelperInterface {

    public function getListEntityByGroupId($groupId);
    public function getListGroups();
    public function getListEntities();
}