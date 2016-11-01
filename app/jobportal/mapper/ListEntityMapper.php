<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26/10/2016
 * Time: 8:49 PM
 */

namespace App\jobportal\mapper;


use App\Http\ViewModels\ListEntityViewModel;
use Illuminate\Http\Request;

class ListEntityMapper
{
    public static function setListEntity(Request $listEntityRequest)
    {
        $listEntityVM = new ListEntityViewModel();
        $listEntity = (object) $listEntityRequest->all();

        //$userName = Session::get('DisplayName');
        $userName = 'Admin';

        $listEntityVM->setListGroupId($listEntity->listGroupId);

        $listEntityVM->setListEntityId($listEntity->listEntityId);
        $listEntityVM->setListEntityName($listEntity->listEntityName);
        $listEntityVM->setEntityDescription(property_exists($listEntity, 'entityDescription') ? $listEntity->entityDescription : null);
        $listEntityVM->setCode(property_exists($listEntity, 'code') ? $listEntity->code : null);
        $listEntityVM->setParentId(property_exists($listEntity, 'parentId') ? $listEntity->parentId : null);
        $listEntityVM->setSequenceNo(property_exists($listEntity, 'sequenceNo') ? $listEntity->sequenceNo : null);
        $listEntityVM->setDeleteStatus(1);
        $listEntityVM->setCreatedBy($userName);
        $listEntityVM->setUpdatedBy($userName);
        $listEntityVM->setCreatedAt(date("Y-m-d H:i:s"));
        $listEntityVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $listEntityVM;
    }
}