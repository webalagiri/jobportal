<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/17/2016
 * Time: 2:19 PM
 */

namespace App\jobportal\mapper;

use App\Http\ViewModels\ApplyJobViewModel;
use App\Http\ViewModels\CandidateEmploymentViewModel;
use App\Http\ViewModels\CandidatePreferencesViewModel;
use App\Http\ViewModels\CandidateProjectViewModel;
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
        //$candidateProfileVM->setEmail($profile->email);
        $candidateProfileVM->setEmail(property_exists($profile, 'email') ? $profile->email : null);
        $candidateProfileVM->setPhone(property_exists($profile, 'phone') ? $profile->phone : null);
        //$candidateProfileVM->setPhone($profile->phone);
        //$candidateProfileVM->setPhone(isset($profile->phone) ? $profile->phone : $value);
        //$candidateProfileVM->setMobile($profile->mobile);
        $candidateProfileVM->setMobile(property_exists($profile, 'mobile') ? $profile->mobile : null);
        $candidateProfileVM->setLocation(property_exists($profile, 'location') ? $profile->location : null);
        $candidateProfileVM->setAddress($profile->address);
        $candidateProfileVM->setAlternateMobile(property_exists($profile, 'alternateMobile') ? $profile->alternateMobile : null);
        $candidateProfileVM->setCity($profile->city);
        $candidateProfileVM->setCountry($profile->country);
        $candidateProfileVM->setPincode($profile->pincode);
        $candidateProfileVM->setGender($profile->gender);
        $candidateProfileVM->setDateOfBirth($profile->dateOfBirth);
        $candidateProfileVM->setMaritalStatus($profile->maritalStatus);
        $candidateProfileVM->setPhysicallyChallenged(property_exists($profile, 'physicallyChallenged') ? $profile->physicallyChallenged : null);
        $candidateProfileVM->setPhoto(property_exists($profile, 'photo') ? $profile->photo : null);

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

        $candidateEmpVM->setCreatedBy($userName);
        $candidateEmpVM->setUpdatedBy($userName);
        $candidateEmpVM->setCreatedAt(date("Y-m-d H:i:s"));
        $candidateEmpVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $candidateEmpVM;

    }

    public static function setCandidateProjectDetails(Request $candidateRequest)
    {
        $candidateProjectVM = new CandidateProjectViewModel();
        $candidateProjects = (object) $candidateRequest->all();
        //dd($candidateEmp);
        $userName = 'Admin';

        $candidateProjectVM->setCandidateId($candidateProjects->candidateId);
        $projects = $candidateProjects->projects;
        //dd($candidateEmployments);

        foreach($projects as $project)
        {
            $candidateProjectVM->setCandidateProjects($project);
        }

        $candidateProjectVM->setCreatedBy($userName);
        $candidateProjectVM->setUpdatedBy($userName);
        $candidateProjectVM->setCreatedAt(date("Y-m-d H:i:s"));
        $candidateProjectVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $candidateProjectVM;

    }

    public static function setCandidatePreferences(Request $candidateRequest)
    {
        $candidatePreferenceVM = new CandidatePreferencesViewModel();
        $candidatePreferences = (object) $candidateRequest->all();
        //dd($candidateEmp);
        $userName = 'Admin';

        $candidatePreferenceVM->setCandidateId($candidatePreferences->candidateId);
        $preferences = $candidatePreferences->preferences;
        //dd($candidateEmployments);

        foreach($preferences as $preference)
        {
            $candidatePreferenceVM->setCandidatePreferences($preference);
        }

        $candidatePreferenceVM->setCreatedBy($userName);
        $candidatePreferenceVM->setUpdatedBy($userName);
        $candidatePreferenceVM->setCreatedAt(date("Y-m-d H:i:s"));
        $candidatePreferenceVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $candidatePreferenceVM;

    }

    public static function setApplyJobDetails(Request $applyJobRequest)
    {
        $applyJobVM = new ApplyJobViewModel();
        $applyJob = (object) $applyJobRequest->all();
        //$userName = Session::get('DisplayName');
        $userName = 'Admin';

        $applyJobVM->setCandidateId($applyJob->candidateId);
        $applyJobVM->setCompanyId($applyJob->companyId);
        $applyJobVM->setJobId($applyJob->jobId);
        $applyJobVM->setCreatedBy($userName);
        $applyJobVM->setUpdatedBy($userName);
        $applyJobVM->setCreatedAt(date("Y-m-d H:i:s"));
        $applyJobVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $applyJobVM;
    }
}