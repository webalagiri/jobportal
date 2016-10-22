<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/13/2016
 * Time: 9:55 PM
 */

namespace App\jobportal\repositories\repoimpl;


use App\Http\ViewModels\CompanyViewModel;
use App\jobportal\model\entities\Company;
use App\jobportal\repositories\repointerface\CompanyInterface;
use App\jobportal\utilities\UserType;
use App\Role;

use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use app\jobportal\utilities\Exception\CompanyException;
use App\User;
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

    /* Get company details
     * @params $companyId
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCompanyDetails($companyId)
    {
        $companyDetails = null;

        try
        {
            $query = DB::table('ri_company_profile as rcp')->join('users as usr', 'usr.id', '=', 'rcp.company_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rcp.city');
            $query->join('ri_list_entities as rlecoun', 'rlecoun.id', '=', 'rcp.country');
            $query->join('ri_list_entities as rlecom', 'rlecom.id', '=', 'rcp.company_type');
            $query->where('rcp.company_id', '=', $companyId);
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcp.id as Id', 'rcp.company_id as companyId', 'rcp.company_name as companyName',
                'rcp.email as email', 'rcp.phone as phone', 'rle.list_entity_name as cityName',
                'rle.list_entity_name as countryName',
                'rcp.contact_person as contactPerson');

            $companyDetails = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CompanyException(null, ErrorEnum::COMPANY_DETAILS_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::COMPANY_DETAILS_ERROR, $exc);
        }

        return $companyDetails;
    }

    /* Save company profile
     * @params $companyProfileVM
     * @throws $companyExc
     * @return true | false
     * @author Baskar
     */

    public function saveCompanyProfile(CompanyViewModel $companyProfileVM)
    {
        $status = true;
        $company = null;
        $companyId = null;
        $user = null;



        try
        {
            $companyId = $companyProfileVM->getCompanyId();

            if($companyId == 0)
            {
                $user = $this->processCompanyUser($companyProfileVM);
                $this->attachCompanyRole($user);
                $company = new Company();
            }
            else
            {
                $company = Company::where('company_id', '=', $companyId)->first();
                if(!is_null($company))
                {
                    //$user = User::find($companyId);
                    $user = $this->processCompanyUser($companyProfileVM);
                }
            }

            $company->company_name = $companyProfileVM->getCompanyName();
            $company->description = $companyProfileVM->getDescription();
            $company->company_type = $companyProfileVM->getCompanyType();
            $company->email = $companyProfileVM->getEmail();
            $company->phone = $companyProfileVM->getPhone();
            $company->location = $companyProfileVM->getLocation();
            $company->address = $companyProfileVM->getAddress();
            $company->city = $companyProfileVM->getCity();
            $company->country = $companyProfileVM->getCountry();
            $company->pincode = $companyProfileVM->getPincode();
            $company->company_logo = $companyProfileVM->getCompanyLogo();
            $company->contact_person = $companyProfileVM->getContactPerson();
            $company->contact_person_mobile = $companyProfileVM->getContactPersonMobile();
            $company->created_by = $companyProfileVM->getCreatedBy();
            $company->created_at = $companyProfileVM->getCreatedAt();
            $company->updated_by = $companyProfileVM->getUpdatedBy();
            $company->updated_at = $companyProfileVM->getUpdatedAt();

            $user->company()->save($company);
            //dd("OK");
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            $status = false;
            throw new CompanyException(null, ErrorEnum::COMPANY_PROFILE_SAVE_ERROR, $queryExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $status = false;
            throw new CompanyException(null, ErrorEnum::COMPANY_PROFILE_SAVE_ERROR, $exc);
        }

        return $status;
    }

    private function processCompanyUser(CompanyViewModel $companyProfileVM)
    {
       //$companyId = null;
        $user = null;
        $companyId = $companyProfileVM->getCompanyId();

        if($companyId == 0)
        {
            $user = new User();

        }
        else
        {
            $user = User::find($companyId);
            /*$user->name = $companyProfileVM->getCompanyName();
            $user->email = $companyProfileVM->getEmail();
            $user->password = $companyProfileVM->getCompanyName();
            $user->delete_status = 1;
            $user->created_at = $companyProfileVM->getCreatedAt();
            $user->updated_at = $companyProfileVM->getUpdatedAt();

            $user->save();*/
        }

        $user->name = $companyProfileVM->getCompanyName();
        $user->email = $companyProfileVM->getEmail();
        $user->password = $companyProfileVM->getCompanyName();
        $user->delete_status = 1;
        $user->created_at = $companyProfileVM->getCreatedAt();
        $user->updated_at = $companyProfileVM->getUpdatedAt();

        $user->save();

        return $user;
    }

    private function attachCompanyRole(User $user)
    {
        $role = Role::find(UserType::USERTYPE_CLIENT);

        if (!is_null($role))
        {
            $user->attachRole($role);
        }
    }

    /* Delete a company
     * @params $companyId
     * @throws $companyExc
     * @return true | false
     * @author Baskar
     */

    public function deleteCompany($companyId)
    {
        $status = true;

        try
        {
            $company = User::find($companyId);
            if(!is_null($company))
            {
                $company->delete_status = 0;
                $company->save();
            }
        }
        catch(QueryException $queryExc)
        {
            $status = false;
            throw new CompanyException(null, ErrorEnum::COMPANY_PROFILE_DELETE_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            $status = false;
            throw new CompanyException(null, ErrorEnum::COMPANY_PROFILE_DELETE_ERROR, $exc);
        }

        return $status;
    }
}