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
use App\jobportal\utilities\GroupType;
use App\jobportal\utilities\UserType;
use App\Role;

use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\CompanyException;
use App\Traits\SortKeyTrait;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;

class CompanyImpl implements CompanyInterface
{
    use SortKeyTrait;

    /* Get list of companies
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCompanyList($searchKey = null)
    {
        $companies = null;
        $sort = null;

        try
        {
            $query = DB::table('ri_company_profile as rcp')->join('users as usr', 'usr.id', '=', 'rcp.company_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rcp.city');
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcp.id as Id', 'rcp.company_id as companyId', 'rcp.company_name as companyName',
                'rcp.email as email', 'rcp.phone as phone', 'rle.list_entity_name as cityName',
                'rcp.contact_person as contactPerson');
            //$query->orderBy('rcp.company_name', 'ASC');

            //$companies = $query->get();
            if($this->checkKeyExists($searchKey))
            {
                $sort = $this->getCompanySortValue($searchKey);
                $query->orderBy($sort, 'ASC');
            }
            else
            {
                $query->orderBy('rcp.company_name', 'DESC');
            }

            $companies = $query->paginate();
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

    private function checkKeyExists($searchKey)
    {
        $keyExists = true;

        if (!is_null($searchKey))
        {
            if(array_key_exists($searchKey, $this->getCompanySortKeyArray()))
            {
                //$keyExists = true;
                $sort = $this->getCompanySortValue($searchKey);
                if(is_null($sort))
                {
                    $keyExists = false;
                }
            }
            else
            {
                $keyExists = false;
                //$query->orderBy('rj.job_active_from', 'DESC');
            }

        }
        else{
            $keyExists = false;
            //$query->orderBy('rj.job_active_from', 'DESC');
        }

        return $keyExists;
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

    /* Get count of companies
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCompanyCount()
    {
        $companyCount = null;

        try
        {
            $query = DB::table('ri_company_profile as rcp')->join('users as usr', 'usr.id', '=', 'rcp.company_id');
            $query->where('usr.delete_status', '=', 1);
            //$query->select('count(*) as companyCount');
            //$query->orderBy('rcp.company_name', 'ASC');

            //dd($query->toSql());
            $companyCount = $query->count();
            //dd($companyCount);
            //$companies = $query->paginate();
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            throw new CompanyException(null, ErrorEnum::COMPANY_COUNT_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::COMPANY_COUNT_ERROR, $exc);
        }

        return $companyCount;
    }

    /* Get list of industries
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getIndustries()
    {
        $industries = null;
        $industryId = GroupType::INDUSTRY_AREA;

        try
        {
            $query = DB::table('ri_list_entities as rle')->join('ri_list_group as rlg', 'rlg.id', '=', 'rle.list_group_id');
            $query->where('rle.list_group_id', '=', $industryId);
            $query->where('rle.delete_status', '=', 1);
            $query->select('rle.id as Id', 'rle.list_entity_name as industryName',
                'rle.entity_description as customerDetails',
                'rlg.id as groupId', 'rlg.list_group_name as listGroupName');
            //$query->orderBy('rcp.company_name', 'ASC');

            //$companies = $query->get();
            $industries = $query->paginate();
        }
        catch(QueryException $queryExc)
        {
            throw new CompanyException(null, ErrorEnum::INDUSTRY_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::INDUSTRY_LIST_ERROR, $exc);
        }

        return $industries;
    }

    /* Get list of industries
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getFunctionalAreas()
    {
        $functionalAreas = null;
        $functionalId = GroupType::FUNCTIONAL_AREA;

        try
        {
            $query = DB::table('ri_list_entities as rle')->join('ri_list_group as rlg', 'rlg.id', '=', 'rle.list_group_id');
            $query->where('rle.list_group_id', '=', $functionalId);
            $query->where('rle.delete_status', '=', 1);
            $query->select('rle.id as Id', 'rle.list_entity_name as functionalArea',
                'rle.entity_description as customerDetails',
                'rlg.id as groupId', 'rlg.list_group_name as listGroupName');
            //$query->orderBy('rcp.company_name', 'ASC');

            //$companies = $query->get();
            $functionalAreas = $query->paginate();
        }
        catch(QueryException $queryExc)
        {
            throw new CompanyException(null, ErrorEnum::INDUSTRY_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::INDUSTRY_LIST_ERROR, $exc);
        }

        return $functionalAreas;
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

        return array($status,$company);
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

    /* Get list of latest jobs
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getLatestJobs()
    {
        $latestJobs = null;

        try
        {
           //$query->orderBy('rcp.company_name', 'ASC');
        /*
            $query = DB::table('ri_jobs as rj')->join('users as usr', 'usr.id', '=', 'rj.company_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rj.job_post_type');
            $query->join('ri_list_entities as rle1', 'rle1.id', '=', 'rj.job_industry_area');
            $query->join('ri_list_entities as rle2', 'rle2.id', '=', 'rj.job_functional_area');
            $query->join('ri_list_entities as rle3', 'rle3.id', '=', 'rj.location');
            $query->where('usr.delete_status', '=', 1);
            $query->where('rj.job_status', '=', 1);

            $query->select('rj.id as Id', 'rj.company_id as companyId', 'usr.name as companyName',
                'rj.job_post_name as jobPostName', 'rj.job_description as jobDescription',
                'rle.list_entity_name as jobPostType', 'rle3.list_entity_name as location',
                'rj.job_experience as experience', 'rj.job_skills as skills',
                'rle1.list_entity_name as industryArea',
                'rle2.list_entity_name as functionalArea',
                'rj.job_active_from as activeFrom', 'rj.job_active_to as activeTo');
            $query->orderBy('rj.job_active_from', 'DESC');
        */

            $query = DB::table('ri_jobs as rj')->join('users as usr', 'usr.id', '=', 'rj.company_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rj.job_post_type');
            $query->join('ri_list_entities as rle1', 'rle1.id', '=', 'rj.job_industry_area');
            $query->join('ri_list_entities as rle2', 'rle2.id', '=', 'rj.job_functional_area');
            $query->where('usr.delete_status', '=', 1);
            $query->where('rj.job_status', '=', 1);

            $query->select('rj.id as Id', 'rj.company_id as companyId', 'usr.name as companyName',
                'rj.job_post_name as jobPostName', 'rj.job_description as jobDescription',
                'rle.list_entity_name as jobPostType',
                'rj.job_experience as experience', 'rj.job_skills as skills',
                'rle1.list_entity_name as industryArea',
                'rle2.list_entity_name as functionalArea',
                'rj.job_active_from as activeFrom', 'rj.job_active_to as activeTo');
            $query->orderBy('rj.job_active_from', 'DESC');

            //dd($query->toSql());
            //$companies = $query->get();
            $latestJobs = $query->paginate();
        }
        catch(QueryException $queryExc)
        {
            throw new CompanyException(null, ErrorEnum::JOB_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::JOB_LIST_ERROR, $exc);
        }

        return $latestJobs;
    }

    public function getJobInterviews($search = null)
    {
        $jobInterviews = null;

        try
        {
            $query = DB::table('ri_job_interview as rji')->join('users as usr1', 'usr1.id', '=', 'rji.company_id');
            $query->join('users as usr2', 'usr2.id', '=', 'rji.candidate_id');
            $query->join('ri_job_application as rja', 'rja.id', '=', 'rji.job_application_id');
            $query->join('ri_jobs as rj', 'rj.id', '=', 'rji.job_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rj.job_post_type');
            $query->join('ri_list_entities as rle1', 'rle1.id', '=', 'rj.job_industry_area');
            $query->join('ri_list_entities as rle2', 'rle2.id', '=', 'rj.job_functional_area');
            $query->join('ri_list_entities as rle3', 'rle3.id', '=', 'rj.location');
            $query->where('usr1.delete_status', '=', 1);
            $query->where('usr2.delete_status', '=', 1);
            $query->where('rj.job_status', '=', 1);

            $query->select('rj.id as Id', 'rj.company_id as companyId', 'usr.name as companyName',
                'rj.job_post_name as jobPostName', 'rj.job_description as jobDescription',
                'rle.list_entity_name as jobPostType', 'rle3.list_entity_name as location',
                'rj.job_experience as experience', 'rj.job_skills as skills',
                'rle1.list_entity_name as industryArea',
                'rle2.list_entity_name as functionalArea',
                'rj.job_active_from as activeFrom', 'rj.job_active_to as activeTo');
            $query->orderBy('rj.job_active_from', 'DESC');

            //dd($query->toSql());
            //$companies = $query->get();
            $latestJobs = $query->paginate();
        }
        catch(QueryException $queryExc)
        {
            throw new CompanyException(null, ErrorEnum::JOB_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::JOB_LIST_ERROR, $exc);
        }

        return $latestJobs;
    }
}