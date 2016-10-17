<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/13/2016
 * Time: 9:55 PM
 */

namespace App\jobportal\repositories\repointerface;


use App\Http\ViewModels\CompanyViewModel;

interface CompanyInterface {

    public function getCompanyList();
    public function getCompanyDetails($companyId);
    public function saveCompanyProfile(CompanyViewModel $companyProfileVM);

}