<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/11/2016
 * Time: 7:21 PM
 */

namespace App\jobportal\repositories\repoimpl;

use App\jobportal\repositories\repointerface\HelperInterface;

use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\HelperException;

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