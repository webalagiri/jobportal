<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/14/2016
 * Time: 3:15 PM
 */

namespace App\jobportal\repositories\repoimpl;

use App\Http\ViewModels\JobViewModel;
use App\jobportal\model\entities\JobProfile;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\JobException;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;

use App\jobportal\repositories\repointerface\JobInterface;

class JobImpl implements JobInterface
{

    /* Get list of jobs
     * @params none
     * @throws $jobException
     * @return array | null
     * @author Baskar
     */

    public function getJobList()
    {
        $jobs = null;

        try
        {
            $query = DB::table('ri_jobs as rj')->join('users as usr', 'usr.id', '=', 'rj.company_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rj.job_post_type');
            $query->join('ri_list_entities as rle1', 'rle1.id', '=', 'rj.job_industry_area');
            $query->join('ri_list_entities as rle2', 'rle2.id', '=', 'rj.job_functional_area');
            $query->where('usr.delete_status', '=', 1);
            $query->where('rj.job_status', '=', 1);
            $query->select('rj.id as Id', 'rj.company_id as companyId', 'usr.name as companyName',
                'rj.job_post_name as jobPostName', 'rle.list_entity_name as jobPostType',
                'rj.job_experience as experience', 'rj.job_skills as skills',
                'rle1.list_entity_name as industryArea',
                'rle2.list_entity_name as functionalArea',
                'rj.job_active_from as activeFrom', 'rj.job_active_to as activeTo');
            $query->orderBy('rj.job_active_from', 'ASC');

            $jobs = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new JobException(null, ErrorEnum::JOB_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new JobException(null, ErrorEnum::JOB_LIST_ERROR, $exc);
        }

        return $jobs;
    }

    /* Get job details
     * @params none
     * @throws $jobException
     * @return array | null
     * @author Baskar
     */

    public function getJobDetails($jobId)
    {
        $jobDetails = null;

        try
        {
            $query = DB::table('ri_jobs as rj')->join('users as usr', 'usr.id', '=', 'rj.company_id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rj.job_post_type');
            $query->join('ri_list_entities as rle1', 'rle1.id', '=', 'rj.job_industry_area');
            $query->join('ri_list_entities as rle2', 'rle2.id', '=', 'rj.job_functional_area');
            $query->where('rj.id', '=', $jobId);
            $query->where('usr.delete_status', '=', 1);
            $query->where('rj.job_status', '=', 1);
            $query->select('rj.id as Id', 'rj.company_id as companyId', 'usr.name as companyName',
                'rj.job_post_name as jobPostName', 'rle.list_entity_name as jobPostType',
                'rj.job_experience as experience', 'rj.job_skills as skills',
                'rle1.list_entity_name as industryArea',
                'rle2.list_entity_name as functionalArea',
                'rj.job_active_from as activeFrom', 'rj.job_active_to as activeTo');
            $query->orderBy('rj.job_active_from', 'ASC');

            $jobDetails = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new JobException(null, ErrorEnum::JOB_DETAILS_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new JobException(null, ErrorEnum::JOB_DETAILS_ERROR, $exc);
        }

        return $jobDetails;
    }

    /* Create new job
     * @params $jobViewModel
     * @throws $jobException
     * @return true | false
     * @author Baskar
     */

    public function saveJobProfile(JobViewModel $jobVM)
    {
        $status = true;
        $jobProfile = null;
        $jobId = null;

        try
        {
            $companyUser = User::find($jobVM->getCompanyId());
            $jobId = $jobVM->getJobId();

            if(!is_null($companyUser))
            {
                if($jobId == 0)
                {
                    $jobProfile = new JobProfile();
                }
                else
                {
                    $jobProfile = JobProfile::find($jobId);
                }

                $jobProfile->job_post_name = $jobVM->getJobPostName();
                $jobProfile->job_description = $jobVM->getJobDescription();
                $jobProfile->job_post_type = $jobVM->getJobPostType();
                $jobProfile->job_post_vacancy = $jobVM->getJobVacancy();
                $jobProfile->job_experience = $jobVM->getJobExperience();
                $jobProfile->job_salary_min = $jobVM->getJobSalaryMin();
                $jobProfile->job_salary_max = $jobVM->getJobSalaryMax();
                $jobProfile->job_skills = $jobVM->getJobSkills();
                $jobProfile->job_industry_area = $jobVM->getJobIndustryArea();
                $jobProfile->job_functional_area = $jobVM->getJobFunctionalArea();
                $jobProfile->job_active_from = $jobVM->getJobActiveFrom();
                $jobProfile->job_active_to = $jobVM->getJobActiveTo();
                $jobProfile->job_status = $jobVM->getJobStatus();
                $jobProfile->created_by = $jobVM->getCreatedBy();
                $jobProfile->created_at = $jobVM->getCreatedAt();
                $jobProfile->updated_by = $jobVM->getUpdatedBy();
                $jobProfile->updated_at = $jobVM->getUpdatedAt();

                $companyUser->jobprofiles()->save($jobProfile);
            }
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            $status = false;
            throw new JobException(null, ErrorEnum::JOB_PROFILE_SAVE_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $status = false;
            throw new JobException(null, ErrorEnum::JOB_PROFILE_SAVE_ERROR, $exc);
        }

        return $status;
    }

    /* Delete job
     * @params $jobId
     * @throws $jobException
     * @return true | false
     * @author Baskar
     */

    public function deleteJob($jobId)
    {
        $status = true;

        try
        {
            $job = JobProfile::find($jobId);
            if(!is_null($job))
            {
                $job->job_status = 0;
                $job->save();
            }
        }
        catch(QueryException $queryExc)
        {
            $status = false;
            throw new JobException(null, ErrorEnum::JOB_PROFILE_DELETE_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            $status = false;
            throw new JobException(null, ErrorEnum::JOB_PROFILE_DELETE_ERROR, $exc);
        }

        return $status;
    }
}