<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/15/2016
 * Time: 5:24 PM
 */

namespace App\jobportal\repositories\repoimpl;


use App\Http\ViewModels\CandidateSkillsViewModel;
use App\Http\ViewModels\CandidateViewModel;
use App\jobportal\model\entities\CandidateJobProfile;
use App\jobportal\model\entities\CandidatePersonalProfile;
use App\jobportal\model\entities\CandidateSkills;
use App\jobportal\repositories\repointerface\CandidateInterface;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\CandidateException;

use App\jobportal\utilities\UserType;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;

class CandidateImpl implements CandidateInterface
{

    /* Get list of candidates
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidates()
    {
        $candidates = null;
        //dd('Inside candidate impl');

        try
        {
            $query = DB::table('ri_candidate_personal_profile as rcpp')->join('users as usr', 'usr.id', '=', 'rcpp.candidate_id');
            $query->join('ri_candidate_job_profile as rcjp', 'rcjp.candidate_id', '=', 'usr.id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rcpp.city');
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcpp.id as Id', 'rcpp.candidate_id as candidateId', 'rcpp.first_name as firstName',
                'rcpp.last_name as lastName', 'rcpp.email as email', 'rcpp.phone as phone', 'rle.list_entity_name as city',
                'rcpp.gender as gender',
                'rcjp.profile_name as profileName', 'rcjp.profile_details as profileDetails',
                'rcjp.skills as skills', 'rcjp.total_experience_years as totalExperience');
            $query->orderBy('rcpp.last_name', 'ASC');

            //dd($query->toSql());

            $candidates = $query->get();
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            throw new CandidateException(null, ErrorEnum::CANDIDATE_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            throw new CandidateException(null, ErrorEnum::CANDIDATE_LIST_ERROR, $exc);
        }

        return $candidates;
    }

    /* Get candidate details
     * @params $companyId
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCandidateDetails($candidateId)
    {
        $candidateDetails = null;

        try
        {
            $query = DB::table('ri_candidate_personal_profile as rcpp')->join('users as usr', 'usr.id', '=', 'rcpp.candidate_id');
            $query->join('ri_candidate_job_profile as rcjp', 'rcjp.candidate_id', '=', 'usr.id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rcpp.city');
            $query->where('rcpp.candidate_id', '=', $candidateId);
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcpp.id as Id', 'rcpp.candidate_id as candidateId', 'rcpp.first_name as firstName',
                'rcpp.last_name as lastName', 'rcpp.email as email', 'rcpp.phone as phone', 'rle.list_entity_name as city',
                'rcpp.gender as gender',
                'rcjp.profile_name as profileName', 'rcjp.profile_details as profileDetails',
                'rcjp.skills as skills', 'rcjp.total_experience_years as totalExperience');


            $candidateDetails = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_DETAILS_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_DETAILS_ERROR, $exc);
        }

        return $candidateDetails;
    }

    /* Save candidate profile
     * @params $candidateProfileVM
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateProfile(CandidateViewModel $candidateProfileVM)
    {
        $status = true;
        $candidate = null;
        $candidateId = null;
        $user = null;

        try
        {
            $candidateId = $candidateProfileVM->getCandidateId();
            $user = $this->processCandidateUser($candidateProfileVM);
            if($candidateId == 0)
            {
                //$user = $this->processCandidateUser($candidateProfileVM);
                $this->attachCompanyRole($user);
                $candidate = new CandidatePersonalProfile();
                $jobProfile = new CandidateJobProfile();
                $this->addOrUpdatePersonalProfile($candidate, $candidateProfileVM, $user);
                $this->addOrUpdateJobProfile($jobProfile, $candidateProfileVM, $user);
            }
            else
            {
                $candidate = CandidatePersonalProfile::where('candidate_id', '=', $candidateId)->first();
                $jobProfile = CandidateJobProfile::where('candidate_id', '=', $candidateId)->first();
                $this->addOrUpdatePersonalProfile($candidate, $candidateProfileVM, $user);
                $this->addOrUpdateJobProfile($jobProfile, $candidateProfileVM, $user);
            }

        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            $status = false;
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PROFILE_SAVE_ERROR, $queryExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $status = false;
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PROFILE_SAVE_ERROR, $exc);
        }

        return $status;
    }

    private function processCandidateUser(CandidateViewModel $candidateProfileVM)
    {
        //$candidateId = null;
        $user = null;
        $candidateId = $candidateProfileVM->getCandidateId();

        if($candidateId == 0)
        {
            $user = new User();
        }
        else
        {
            $user = User::find($candidateId);
        }

        $user->name = $candidateProfileVM->getFirstName()." ".$candidateProfileVM->getLastName();
        $user->email = $candidateProfileVM->getEmail();
        $user->password = $candidateProfileVM->getFirstName();
        $user->delete_status = 1;
        $user->created_at = $candidateProfileVM->getCreatedAt();
        $user->updated_at = $candidateProfileVM->getUpdatedAt();

        $user->save();

        return $user;
    }

    private function attachCompanyRole(User $user)
    {
        $role = Role::find(UserType::USERTYPE_CANDIDATE);

        if (!is_null($role))
        {
            $user->attachRole($role);
        }
    }

    private function addOrUpdatePersonalProfile(CandidatePersonalProfile $personalProfile, CandidateViewModel $candidateProfileVM, User $user)
    {
        $personalProfile->first_name = $candidateProfileVM->getFirstName();
        $personalProfile->last_name = $candidateProfileVM->getLastName();
        $personalProfile->email = $candidateProfileVM->getEmail();
        $personalProfile->phone = $candidateProfileVM->getPhone();
        $personalProfile->mobile = $candidateProfileVM->getMobile();
        $personalProfile->location = $candidateProfileVM->getLocation();
        $personalProfile->address = $candidateProfileVM->getAddress();
        $personalProfile->alternate_mobile = $candidateProfileVM->getAlternateMobile();
        $personalProfile->city = $candidateProfileVM->getCity();
        $personalProfile->country = $candidateProfileVM->getCountry();
        $personalProfile->pincode = $candidateProfileVM->getPincode();
        $personalProfile->gender = $candidateProfileVM->getGender();
        $personalProfile->date_of_birth = $candidateProfileVM->getDateOfBirth();
        $personalProfile->marital_status = $candidateProfileVM->getMaritalStatus();
        $personalProfile->physically_challenged = $candidateProfileVM->getPhysicallyChallenged();
        $personalProfile->photo = $candidateProfileVM->getPhoto();
        $personalProfile->created_by = $candidateProfileVM->getCreatedBy();
        $personalProfile->created_at = $candidateProfileVM->getCreatedAt();
        $personalProfile->updated_by = $candidateProfileVM->getUpdatedBy();
        $personalProfile->updated_at = $candidateProfileVM->getUpdatedAt();

        $user->candidatepersonalprofile()->save($personalProfile);

        //return $personalProfile;
    }

    private function addOrUpdateJobProfile(CandidateJobProfile $jobProfile, CandidateViewModel $candidateProfileVM, User $user)
    {
        $jobProfile->total_experience_years = $candidateProfileVM->getTotalYearsExperience();
        $jobProfile->total_experience_months = $candidateProfileVM->getTotalMonthsExperience();
        $jobProfile->current_location = $candidateProfileVM->getCurrentLocation();
        $jobProfile->preferred_lcoation = $candidateProfileVM->getPreferredLocation();
        $jobProfile->job_title = $candidateProfileVM->getJobTitle();
        $jobProfile->skills = $candidateProfileVM->getSkills();

        $user->candidatejobprofile()->save($jobProfile);
    }

    /* Delete a candidate
     * @params $candidateId
     * @throws $candidateException
     * @return true | false
     * @author Baskar
     */

    public function deleteCandidate($candidateId)
    {
        $status = true;

        try
        {
            $candidate = User::find($candidateId);
            if(!is_null($candidate))
            {
                $candidate->delete_status = 0;
                $candidate->save();
            }
        }
        catch(QueryException $queryExc)
        {
            $status = false;
            throw new CandidateException(null, ErrorEnum::COMPANY_PROFILE_DELETE_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            $status = false;
            throw new CandidateException(null, ErrorEnum::COMPANY_PROFILE_DELETE_ERROR, $exc);
        }

        return $status;
    }

    /* Get candidate skills
     * @params $candidateId
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidateSkills($candidateId)
    {
        $candidateSkills = null;

        try
        {
            $query = DB::table('ri_candidate_skills as rcs')->join('users as usr', 'usr.id', '=', 'rcs.candidate_id');
            $query->where('rcs.candidate_id', '=', $candidateId);
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcs.id as Id', 'rcs.candidateId as candidateId',
                'rcs.skill_name as skillName', 'rcs.skill_version as skillVersion',
                'rcs.last_used as lastUsed', 'rcs.experience_years as experienceYears',
                'rcs.experience_months as experienceMonths');

            $candidateSkills = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_SKILLS_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_SKILLS_LIST_ERROR, $exc);
        }

        return $candidateSkills;
    }

    /* Get candidate employment details
     * @params $candidateId
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidateEmployment($candidateId)
    {
        $candidateEmployment = null;

        try
        {
            $query = DB::table('ri_candidate_employment as rce')->join('users as usr', 'usr.id', '=', 'rce.candidate_id');
            $query->where('rce.candidate_id', '=', $candidateId);
            $query->where('usr.delete_status', '=', 1);
            $query->select('rce.id as Id', 'rce.candidate_id as candidateId',
                'rce.company_name as companyName', 'rce.designation as designation',
                'rce.experience_years as experienceYears', 'rce.experience_months as experienceMonths',
                'rce.employment_status as experienceStatus', 'rce.duration_from_years as durationFromYears',
                'rce.duration_from_months as durationFromMonths', 'rce.duration_to_years as durationToYears',
                'rce.duration_to_months as durationToMonths', 'rce.annual_salary as annualSalary',
                'rce.notice_period as noticePeriod');

            $candidateEmployment = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_EMPLOYMENT_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_EMPLOYMENT_LIST_ERROR, $exc);
        }

        return $candidateEmployment;
    }

    /* Get candidate project details
     * @params $candidateId
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidateProjects($candidateId)
    {
        $candidateProjects = null;

        try
        {
            $query = DB::table('ri_candidate_projects as rcp')->join('users as usr', 'usr.id', '=', 'rcp.candidate_id');
            $query->where('rcp.candidate_id', '=', $candidateId);
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcp.id as Id', 'rcp.candidate_id as candidateId',
                'rcp.client as client', 'rcp.project_title as projectTitle',
                'rcp.duration_years_from as durationYearsFrom',
                'rcp.duration_months_from as durationMonthsFrom', 'rcp.duration_years_to as durationYearsTo',
                'rcp.duration_months_to as durationMonthsTo', 'rcp.project_location as projectLocation',
                'rcp.employment_status as employmentStatus', 'rcp.project_details as projectDetails',
                'rcp.skills as skills', 'rcp.role_description as roleDescription', 'rcp.role', 'rcp.team_size as teamSize');

            $candidateProjects = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PROJECTS_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PROJECTS_LIST_ERROR, $exc);
        }

        return $candidateProjects;
    }

    /* Get candidate preferences
     * @params $candidateId
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidatePreferences($candidateId)
    {
        $candidatePreferences = null;

        try
        {
            $query = DB::table('ri_candidate_preferences as rcp')->join('users as usr', 'usr.id', '=', 'rcp.candidate_id');
            $query->where('rcp.candidate_id', '=', $candidateId);
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcp.id as Id', 'rcp.candidate_id as candidateId',
                'rcp.job_type as jobType', 'rcp.employment_type as employmentType',
                'rcp.industry as industry',
                'rcp.recommended_companies as recommendedCompanies', 'rcp.dream_companies as dreamCompanies',
                'rcp.preferred_skills as preferredSkills', 'rcp.companies_interviewed_with as companiesInterviewedWith',
                'rcp.preferred_roles as preferredRoles');

            $candidatePreferences = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PREFERENCES_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PREFERENCES_LIST_ERROR, $exc);
        }

        return $candidatePreferences;
    }

    /* Save candidate skills
     * @params $candidateSkillsVM
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateSkills(CandidateSkillsViewModel $candidateSkillsVM)
    {
        $status = true;
        $user = null;

        try
        {
            $user = User::find($candidateSkillsVM->getCandidateId());

            if(!is_null($user))
            {
                foreach($candidateSkillsVM->getCandidateSkills() as $skill)
                {
                    //dd($skill['skillName']);
                    //dd($skill);
                    $candidateSkills = new CandidateSkills();
                    $candidateSkills->skill_name = $skill->skillName;
                    $candidateSkills->skill_version = $skill->skillVersion;
                    $candidateSkills->last_used = $skill->lastUsed;
                    $candidateSkills->experience_years = $skill->experienceYears;
                    $candidateSkills->experience_months = $skill->experienceMonths;
                    $candidateSkills->created_by = $candidateSkillsVM->getCreatedBy();
                    $candidateSkills->updated_by = $candidateSkillsVM->getUpdatedBy();
                    $candidateSkills->created_at = $candidateSkillsVM->getCreatedAt();
                    $candidateSkills->updated_at = $candidateSkillsVM->getUpdatedAt();

                    $user->candidateskills()->save($candidateSkills);
                    //$candidateSkillsVM->setCandidateSkills($skill);
                }
            }
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            throw new CandidateException(null, ErrorEnum::CANDIDATE_SKILLS_SAVE_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            throw new CandidateException(null, ErrorEnum::CANDIDATE_SKILLS_SAVE_ERROR, $exc);
        }

        return $status;
    }
}