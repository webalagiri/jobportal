<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/14/2016
 * Time: 3:31 PM
 */

namespace App\jobportal\services;


use App\jobportal\repositories\repointerface\JobInterface;
use app\jobportal\utilities\Exception\JobException;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;

use Illuminate\Support\Facades\DB;
use Exception;

class JobService
{
    protected $jobRepo;

    public function __construct(JobInterface $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

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
            $jobs = $this->jobRepo->getJobList();
        }
        catch(JobException $jobExc)
        {
            throw $jobExc;
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
            $jobDetails = $this->jobRepo->getJobDetails($jobId);
        }
        catch(JobException $jobExc)
        {
            throw $jobExc;
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

    public function saveJobProfile($jobVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($jobVM, &$status)
            {
                $status = $this->jobRepo->saveJobProfile($jobVM);
            });

        }
        catch(JobException $jobExc)
        {
            $status = false;
            throw $jobExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new JobException(null, ErrorEnum::JOB_PROFILE_SAVE_ERROR, $ex);
        }

        return $status;
    }
}