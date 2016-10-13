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

class HelperImpl implements HelperInterface
{
    /* Get master data by group Id
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
}