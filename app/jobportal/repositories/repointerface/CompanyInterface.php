<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/13/2016
 * Time: 9:55 PM
 */

namespace App\jobportal\repositories\repointerface;


use App\Http\ViewModels\CompanyViewModel;
use App\Http\ViewModels\ManageInterviewViewModel;

interface CompanyInterface {

    public function getCompanyList($paginate = null, $searchKey = null);
    public function getCompanyDetails($companyId);
    public function saveCompanyProfile(CompanyViewModel $companyProfileVM);
    public function deleteCompany($companyId);

    public function getLatestJobs();
    //public function getLatestJobApplications();
    public function getJobInterviews($search = null);

    public function getIndustries();
    public function getFunctionalAreas();

    public function getCompanyCount();
    public function getInterviewList(ManageInterviewViewModel $interviewVM, $paginate = null);
}