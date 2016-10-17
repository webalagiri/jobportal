<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/15/2016
 * Time: 8:04 PM
 */

namespace App\jobportal\mapper;

use App\Http\ViewModels\CompanyViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompanyProfileMapper
{
    public static function setCompanyProfile(Request $companyRequest)
    {
        $companyProfileVM = new CompanyViewModel();
        $profile = (object) $companyRequest->all();

        //$userName = Session::get('DisplayName');
        $userName = 'Admin';

        $companyProfileVM->setCompanyId($profile->companyId);
        $companyProfileVM->setCompanyName($profile->companyName);
        $companyProfileVM->setDescription($profile->companyDescription);
        $companyProfileVM->setCompanyType($profile->companyType);
        $companyProfileVM->setEmail($profile->email);
        $companyProfileVM->setPhone($profile->phone);
        $companyProfileVM->setLocation($profile->location);
        $companyProfileVM->setAddress($profile->address);
        $companyProfileVM->setCity($profile->city);
        $companyProfileVM->setCountry($profile->country);
        $companyProfileVM->setPincode($profile->pincode);
        $companyProfileVM->setCompanyLogo($profile->companyLogo);
        $companyProfileVM->setContactPerson($profile->contactPerson);
        $companyProfileVM->setContactPersonMobile($profile->contactPersonMobile);
        $companyProfileVM->setCreatedBy($userName);
        $companyProfileVM->setUpdatedBy($userName);
        $companyProfileVM->setCreatedAt(date("Y-m-d H:i:s"));
        $companyProfileVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $companyProfileVM;
    }
}