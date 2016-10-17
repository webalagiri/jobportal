<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/13/2016
 * Time: 10:01 PM
 */

namespace App\jobportal\services;

use App\jobportal\repositories\repointerface\CompanyInterface;

use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\CompanyException;

use Illuminate\Support\Facades\DB;
use Exception;

class CompanyService
{

    protected $companyRepo;

    public function __construct(CompanyInterface $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

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
            $companies = $this->companyRepo->getCompanyList();
        }
        catch(CompanyException $companyExc)
        {
            throw $companyExc;
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
            $companyDetails = $this->companyRepo->getCompanyDetails($companyId);
        }
        catch(CompanyException $companyExc)
        {
            throw $companyExc;
        }
        catch(Exception $exc)
        {
            throw new CompanyException(null, ErrorEnum::COMPANY_DETAILS_ERROR, $exc);
        }

        return $companyDetails;
    }

    /* Save company profile
     * @params $companyRequest
     * @throws $companyExc
     * @return true | false
     * @author Baskar
     */

    public function saveCompanyProfile($companyProfileVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($companyProfileVM, &$status)
            {
                $status = $this->companyRepo->saveCompanyProfile($companyProfileVM);
            });

        }
        catch(CompanyException $oompanyExc)
        {
            $status = false;
            throw $oompanyExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new CompanyException(null, ErrorEnum::COMPANY_PROFILE_SAVE_ERROR, $ex);
        }

        return $status;
    }

    /* Delete a company
     * @params $companyId
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function deleteCompany($companyId)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($companyId, &$status)
            {
                $status = $this->companyRepo->deleteCompany($companyId);
            });

        }
        catch(CompanyException $oompanyExc)
        {
            $status = false;
            throw $oompanyExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new CompanyException(null, ErrorEnum::COMPANY_PROFILE_DELETE_ERROR, $ex);
        }

        return $status;
    }

}