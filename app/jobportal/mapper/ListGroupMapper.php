<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26/10/2016
 * Time: 4:36 PM
 */

namespace App\jobportal\mapper;


use App\Http\ViewModels\ListGroupVM;
use Illuminate\Http\Request;

class ListGroupMapper
{
    public static function setListGroup(Request $listGroupRequest)
    {
        $listGroupVM = new ListGroupVM();
        $listGroups = (object) $listGroupRequest->all();

        //$userName = Session::get('DisplayName');
        $userName = 'Admin';

        $listGroupVM->setListGroupId($listGroups->listGroupId);
        $listGroupVM->setListGroupName($listGroups->listGroupName);
        $listGroupVM->setListGroupCode(property_exists($listGroups, 'code') ? $listGroups->listCode : null);
        $listGroupVM->setDeleteStatus(1);
        $listGroupVM->setCreatedBy($userName);
        $listGroupVM->setUpdatedBy($userName);
        $listGroupVM->setCreatedAt(date("Y-m-d H:i:s"));
        $listGroupVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $listGroupVM;
    }
}