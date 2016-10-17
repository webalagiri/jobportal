<?php

namespace App\Http\Controllers\Company;

use App\jobportal\common\ResponseJson;
use App\jobportal\mapper\JobMapper;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\JobException;
use App\jobportal\utilities\Exception\AppendMessage;
use App\jobportal\services\JobService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;
use Log;

class JobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
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
        $responseJson = null;
        //dd('Inside jobs list controller');

        try
        {
            $jobs = $this->jobService->getJobList();
            //dd($listGroups);
            if(!empty($jobs))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::JOB_LIST_SUCCESS));
                $responseJson->setObj($jobs);
                $responseJson->sendSuccessResponse();
            }
        }
        catch(JobException $jobExc)
        {
            //dd($helperExc);
            $errorMsg = $jobExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($jobExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
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
        $responseJson = null;
        //dd('Inside jobs details controller');

        try
        {
            $jobDetails = $this->jobService->getJobDetails($jobId);
            //dd($jobDetails);
            //dd(sizeof($jobDetails));
            //dd(is_null($jobDetails));
            if(!empty($jobDetails))
            {
                //dd('Inside if statement');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::JOB_DETAILS_SUCCESS));
                $responseJson->setObj($jobDetails);
                $responseJson->sendSuccessResponse();
            }
           else
           {
               //dd('Inside else statement');
               $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_JOB_DETAILS_FOUND));
               $responseJson->setObj($jobDetails);
               $responseJson->sendSuccessResponse();
           }
        }
        catch(JobException $jobExc)
        {
            //dd($helperExc);
            $errorMsg = $jobExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($jobExc);
            Log::error($msg);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }

    /* Create new job
     * @params $jobRequest
     * @throws $jobException
     * @return true | false
     * @author Baskar
     */

    public function saveJobProfile(Request $jobRequest)
    {
        $jobVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $jobVM = JobMapper::setJobProfile($jobRequest);
            $status = $this->jobService->saveJobProfile($jobVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::JOB_PROFILE_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(JobException $jobExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::JOB_PROFILE_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($jobExc);
        }
        catch(Exception $exc)
        {
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }
}
