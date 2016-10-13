<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/13/2016
 * Time: 9:55 PM
 */

namespace App\jobportal\repositories\repoimpl;


use App\jobportal\repositories\repointerface\CompanyInterface;

use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use app\jobportal\utilities\Exception\CompanyException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;

class CompanyImpl implements CompanyInterface
{
    /* Get list of companies
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCompanyList()
    {
        $companies = null;

        try
        {
            $query = DB::table('ri_company_profile as rcp')->join('users as usr', 'usr.id', '=', 'rcp.company_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rcp.city');
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcp.id as Id', 'rcp.company_id as companyId', 'rcp.company_name as companyName',
                'rcp.email as email', 'rcp.phone as phone', 'rle.list_entity_name as cityName',
                'rcp.contact_person as contactPerson');
            $query->orderBy('rcp.company_name', 'ASC');

            $companies = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CompanyException(null, ErrorEnum::COMPANY_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::COMPANY_LIST_ERROR, $exc);
        }

        return $companies;
    }

}