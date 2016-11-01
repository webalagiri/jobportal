<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/11/2016
 * Time: 7:20 PM
 */

namespace App\jobportal\repositories\repointerface;


use App\Http\ViewModels\ListEntityViewModel;
use App\Http\ViewModels\ListGroupVM;

interface HelperInterface {

    public function getListEntityByGroupId($groupId);
    public function getListEntityByParentId($parentId);

    public function getListGroups();
    public function getListEntities();

    public function getCities();
    public function getCountries();

    public function saveListGroups(ListGroupVM $listGroupVM);
    public function saveListEntity(ListEntityViewModel $listEntityVM);
    //public function saveListEntities()
    public function ForgotLogin($email);
    public function ChangePassword($passwordRequest);
}