<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/11/2016
 * Time: 7:21 PM
 */

namespace App\jobportal\repositories\repoimpl;

use App\Http\ViewModels\ListEntityViewModel;
use App\Http\ViewModels\ListGroupVM;
use App\jobportal\model\entities\ListEntity;
use App\jobportal\model\entities\ListGroup;
use App\jobportal\repositories\repointerface\HelperInterface;

use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\HelperException;

use App\jobportal\utilities\GroupType;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use App\User;

use Auth;
use Hash;

class HelperImpl implements HelperInterface
{
    /* Get list entity by group Id
     * @params $groupId
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListEntityByGroupId($groupId)
    {
        $listEntities = null;

        try
        {
            $query = DB::table('ri_list_entities as rle')->join('ri_list_group as rlg', 'rlg.id', '=', 'rle.list_group_id');
            $query->where('rle.delete_status', '=', 1);
            $query->select('rle.id as entityId', 'rle.list_entity_name as listEntityName',
                'rlg.id as listGroupId', 'rlg.list_group_name as listGroupName');
            $query->where('rle.list_group_id', '=', $groupId);
            $query->orderBy('rle.id', 'ASC');
            $listEntities = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $exc);
        }

        return $listEntities;
    }

    /* Get list entity by parent Id
     * @params $parentId
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListEntityByParentId($parentId)
    {
        $listEntities = null;

        try
        {
            $query = DB::table('ri_list_entities as rle')->join('ri_list_group as rlg', 'rlg.id', '=', 'rle.list_group_id');
            $query->where('rle.delete_status', '=', 1);
            $query->select('rle.id as entityId', 'rle.list_entity_name as listEntityName',
                'rlg.id as listGroupId', 'rlg.list_group_name as listGroupName');
            $query->where('rle.parent_id', '=', $parentId);
            $query->orderBy('rle.id', 'ASC');
            $listEntities = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $exc);
        }

        return $listEntities;
    }

    /* Get list groups
     * @params none
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListGroups()
    {
        $listGroups = null;

        try
        {
            $query = DB::table('ri_list_group as rlg')->where('rlg.delete_status', '=', 1);
            $query->select('rlg.id as Id', 'rlg.list_group_name as listGroupName', 'rlg.delete_status as deleteStatus');
            $listGroups = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::LIST_GROUP_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_GROUP_ERROR, $exc);
        }

        return $listGroups;
    }

    /* Get all list entities
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getListEntities()
    {
        $listEntities = null;

        try
        {
            $query = DB::table('ri_list_entities as rle')->join('ri_list_group as rlg', 'rlg.id', '=', 'rle.list_group_id');
            $query->where('rle.delete_status', '=', 1);
            $query->select('rle.id as entityId', 'rle.list_entity_name as listEntityName',
                    'rlg.id as listGroupId', 'rlg.list_group_name as listGroupName');
            $query->orderBy('rle.id', 'ASC');
            $listEntities = $query->get();
            //$listEntities = $query->paginate(10);
        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $exc);
        }

        return $listEntities;
    }

   /* Get the list of cities
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getCities()
    {
        $cities = null;
        $citiesGroupId = GroupType::CITIES;

        try
        {
            $query = DB::table('ri_list_entities as rle')->join('ri_list_group as rlg', 'rlg.id', '=', 'rle.list_group_id');
            $query->where('rle.delete_status', '=', 1);
            $query->where('rle.list_group_id', '=', $citiesGroupId);
            $query->select('rle.id as entityId', 'rle.list_entity_name as listEntityName',
                'rlg.id as listGroupId', 'rlg.list_group_name as listGroupName');
            $query->orderBy('rle.list_entity_name', 'ASC');

            $cities = $query->get();
            //$listEntities = $query->paginate(10);
        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::CITY_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::CITY_LIST_ERROR, $exc);
        }

        return $cities;
    }

    /* Get the list of countries
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getCountries()
    {
        $countries = null;
        $countriesGroupId = GroupType::COUNTRIES;

        try
        {
            $query = DB::table('ri_list_entities as rle')->join('ri_list_group as rlg', 'rlg.id', '=', 'rle.list_group_id');
            $query->where('rle.delete_status', '=', 1);
            $query->where('rle.list_group_id', '=', $countriesGroupId);
            $query->select('rle.id as entityId', 'rle.list_entity_name as listEntityName',
                'rlg.id as listGroupId', 'rlg.list_group_name as listGroupName');
            $query->orderBy('rle.list_entity_name', 'ASC');

            $countries = $query->get();
            //$listEntities = $query->paginate(10);
        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::COUNTRY_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::COUNTRY_LIST_ERROR, $exc);
        }

        return $countries;
    }

    /* Save new list group
     * @params $listGroupVM
     * @throws HelperException
     * @return true | false
     * @author Baskar
     */

    public function saveListGroups(ListGroupVM $listGroupVM)
    {
        $status = true;
        $listGroup = null;
        $listGroupId = $listGroupVM->getListGroupId();

        try
        {
            if($listGroupId == 0)
            {
                $listGroup = new ListGroup();
            }
            else
            {
                $listGroup = ListGroup::find($listGroupId);
            }

            $listGroup->list_group_name = $listGroupVM->getListGroupName();
            $listGroup->code = $listGroupVM->getListGroupCode();
            $listGroup->delete_status = $listGroupVM->getDeleteStatus();
            $listGroup->created_by = $listGroupVM->getCreatedBy();
            $listGroup->created_at = $listGroupVM->getCreatedAt();
            $listGroup->updated_by = $listGroupVM->getUpdatedBy();
            $listGroup->updated_at = $listGroupVM->getUpdatedAt();

            $listGroup->save();
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            $status = false;
            throw new HelperException(null, ErrorEnum::NEW_LIST_GROUP_SAVE_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $status = false;
            throw new HelperException(null, ErrorEnum::NEW_LIST_GROUP_SAVE_ERROR, $exc);
        }

        return $status;
    }

    /* Save new list entity
     * @params $listEntityVM
     * @throws HelperException
     * @return true | false
     * @author Baskar
     */

    public function saveListEntity(ListEntityViewModel $listEntityVM)
    {
        $status = true;
        $listEntity = null;
        $listEntityId = $listEntityVM->getListEntityId();

        $listGroupId = $listEntityVM->getListGroupId();
        $listGroup = null;

        try
        {
            $listGroup = ListGroup::find($listGroupId);
            if(!is_null($listGroup))
            {
                if($listEntityId == 0)
                {
                    $listEntity = new ListEntity();
                }
                else
                {
                    $listEntity = ListEntity::find($listEntityId);
                }

                $listEntity->list_entity_name = $listEntityVM->getListEntityName();
                $listEntity->entity_description = $listEntityVM->getEntityDescription();
                $listEntity->code = $listEntityVM->getCode();
                $listEntity->parent_id = $listEntityVM->getParentId();
                $listEntity->sequence_no = $listEntityVM->getSequenceNo();
                $listEntity->delete_status = $listEntityVM->getDeleteStatus();
                $listEntity->created_by = $listEntityVM->getCreatedBy();
                $listEntity->created_at = $listEntityVM->getCreatedAt();
                $listEntity->updated_by = $listEntityVM->getUpdatedBy();
                $listEntity->updated_at = $listEntityVM->getUpdatedAt();

                //$listGroup->save();
                $listGroup->listentities()->save($listEntity);
            }
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            $status = false;
            throw new HelperException(null, ErrorEnum::NEW_LIST_ENTITY_SAVE_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $status = false;
            throw new HelperException(null, ErrorEnum::NEW_LIST_ENTITY_SAVE_ERROR, $exc);
        }

        return $status;
    }

    /* Forgot Login
     * @params $email
     * @throws HelperException
     * @return array | null
     * @author Vimal
     */

    public function ForgotLogin($email)
    {
        $userSession = null;
        try
        {
            $userSession = User::where('email', '=', $email)->first();
        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $exc);
        }

        return $userSession;
    }


    /* ChangePassword
     * @params $email
     * @throws HelperException
     * @return array | null
     * @author Vimal
     */

    public function ChangePassword($passwordRequest)
    {
        $userInfo = null;
        $userInfoStatus = false;

        try
        {

            $userId = $passwordRequest->user_id;

            $user = User::where('id',$userId) -> first();

            if(Hash::check($passwordRequest->old_password, $user->password))
            {

                if($passwordRequest->old_password != $passwordRequest->new_password) {
                    $userInfoStatus = true;
                    $new_password = Hash::make($passwordRequest->new_password);
                    $user->password = $new_password;
                    $user->save();
                    $userInfo=$user;
                    //Auth::logout();
                    //Session::flush();
                }
            }

        }
        catch(QueryException $queryExc)
        {
            throw new HelperException(null, ErrorEnum::CHANGE_PASSWORD_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::CHANGE_PASSWORD_ERROR, $exc);
        }

        return $userInfo;
    }


}