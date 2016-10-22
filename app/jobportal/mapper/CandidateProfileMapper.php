<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/17/2016
 * Time: 2:19 PM
 */

namespace App\jobportal\mapper;

use App\Http\ViewModels\CandidateEmploymentViewModel;
use App\Http\ViewModels\CandidateSkillsViewModel;
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

    public static function setCandidateSkills(Request $candidateRequest)
    {
        $candidateSkillsVM = new CandidateSkillsViewModel();
        $candidateSkills = (object) $candidateRequest->all();
        //$value = 'NULL';

        $userName = 'Admin';

        $candidateSkillsVM->setCandidateId($candidateSkills->candidateId);
        $skillsList = $candidateSkills->skills;
        //dd($skillsList);

        foreach($skillsList as $skill)
        {
            $candidateSkillsVM->setCandidateSkills($skill);
        }

        $candidateSkillsVM->setCreatedBy($userName);
        $candidateSkillsVM->setUpdatedBy($userName);
        $candidateSkillsVM->setCreatedAt(date("Y-m-d H:i:s"));
        $candidateSkillsVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $candidateSkillsVM;
    }

    public static function setCandidateEmploymentDetails(Request $candidateRequest)
    {
        $candidateEmpVM = new CandidateEmploymentViewModel();
        $candidateEmp = (object) $candidateRequest->all();
        //dd($candidateEmp);
        $userName = 'Admin';

        $candidateEmpVM->setCandidateId($candidateEmp->candidateId);
        $candidateEmployments = $candidateEmp->employments;
        //dd($candidateEmployments);

        foreach($candidateEmployments as $employment)
        {
            $candidateEmpVM->setCandidateEmp($employment);
        }

        /*$candidateEmpVM->setCompanyName($candidateEmp->companyName);
        $candidateEmpVM->setDesignation($candidateEmp->designation);
        $candidateEmpVM->setExperienceYears(property_exists($candidateEmp,'experienceYears') ? $candidateEmp->experienceYears : null);
        $candidateEmpVM->setExperienceMonths(property_exists($candidateEmp,'experienceMonths') ? $candidateEmp->experienceMonths : null);
        $candidateEmpVM->setEmploymentStatus(property_exists($candidateEmp,'employmentStatus') ? $candidateEmp->employmentStatus : null);
        $candidateEmpVM->setDurationFromYears(property_exists($candidateEmp,'durationFromYears') ? $candidateEmp->durationFromYears : null);
        $candidateEmpVM->setDurationFromMonths(property_exists($candidateEmp,'durationFromMonths') ? $candidateEmp->durationFromMonths : null);
        $candidateEmpVM->setDurationToYears(property_exists($candidateEmp,'durationToYears') ? $candidateEmp->durationToYears : null);
        $candidateEmpVM->setDurationToMonths(property_exists($candidateEmp,'durationToMonths') ? $candidateEmp->durationToMonths : null);
        $candidateEmpVM->setAnnualSalary(property_exists($candidateEmp,'annualSalary') ? $candidateEmp->annualSalary : null);
        $candidateEmpVM->setNoticePeriod(property_exists($candidateEmp,'noticePeriod') ? $candidateEmp->noticePeriod : null);
        //$candidateProfileVM->setMobile(property_exists($profile, 'mobile') ? $profile->mobile : null);*/
        $candidateEmpVM->setCreatedBy($userName);
        $candidateEmpVM->setUpdatedBy($userName);
        $candidateEmpVM->setCreatedAt(date("Y-m-d H:i:s"));
        $candidateEmpVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $candidateEmpVM;

    }
}