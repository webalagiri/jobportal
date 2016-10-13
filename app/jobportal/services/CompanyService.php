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

}