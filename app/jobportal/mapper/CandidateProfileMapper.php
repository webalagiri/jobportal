<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/17/2016
 * Time: 2:19 PM
 */

namespace App\jobportal\mapper;

use App\Http\ViewModels\CandidateViewModel;
use Illuminate\Http\Request;

class CandidateProfileMapper
{
    public static function setCandidateProfile(Request $candidateRequest)
    {
        $candidateProfileVM = new CandidateViewModel();
        $profile = (object) $candidateRequest->all();
        $value = 'NULL';

        //$userName = Session::get('DisplayName');
        $userName = 'Admin';

        /*$exists = property_exists($profile, 'phone');
        if($exists)
        {
            return "true";
        }
        else{
            return "false";
        }*/

        $candidateProfileVM->setCandidateId($profile->candidateId);
        $candidateProfileVM->setFirstName($profile->firstName);
        $candidateProfileVM->setLastName($profile->lastName);
        $candidateProfileVM->setEmail($profile->email);
        $candidateProfileVM->setPhone(property_exists($profile, 'phone') ? $profile->phone : null);
        //$candidateProfileVM->setPhone($profile->phone);
        //$candidateProfileVM->setPhone(isset($profile->phone) ? $profile->phone : $value);
        //$candidateProfileVM->setMobile($profile->mobile);
        $candidateProfileVM->setMobile(property_exists($profile, 'mobile') ? $profile->mobile : null);
        $candidateProfileVM->setLocation($profile->location);
        $candidateProfileVM->setAddress($profile->address);
        $candidateProfileVM->setAlternateMobile($profile->alternateMobile);
        $candidateProfileVM->setCity($profile->city);
        $candidateProfileVM->setCountry($profile->country);
        $candidateProfileVM->setPincode($profile->pincode);
        $candidateProfileVM->setGender($profile->gender);
        $candidateProfileVM->setDateOfBirth($profile->dateOfBirth);
        $candidateProfileVM->setMaritalStatus($profile->maritalStatus);
        $candidateProfileVM->setPhysicallyChallenged($profile->physicallyChallenged);
        $candidateProfileVM->setPhoto($profile->photo);

        $candidateProfileVM->setCreatedBy($userName);
        $candidateProfileVM->setUpdatedBy($userName);
        $candidateProfileVM->setCreatedAt(date("Y-m-d H:i:s"));
        $candidateProfileVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $candidateProfileVM;
    }
}