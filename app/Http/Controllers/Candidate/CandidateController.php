<?php

namespace App\Http\Controllers\Candidate;

use App\Http\ViewModels\TrackStatusViewModel;
use App\jobportal\mapper\CandidateProfileMapper;
use App\jobportal\services\CandidateService;
use App\jobportal\services\HelperService;
use App\jobportal\utilities\Exception\CandidateException;
use App\jobportal\utilities\Exception\AppendMessage;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\jobportal\common\ResponseJson;
use App\jobportal\common\UserSession;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\UserType;
use Exception;
use Log;
use App\User;

use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /* Get list of candidates
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidates(Request $candidateRequest)
    {
        $candidates = null;
        $responseJson = null;
        //dd('Inside candidates list controller');

        try
        {
            $paginate = $candidateRequest->get('paginate');
            $candidates = $this->candidateService->getCandidates($paginate);
            //dd($candidates);
            if(!empty($candidates))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LIST_SUCCESS));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }
            else
            {
                //dd('Inside else statement');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_LIST_FOUND));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }

            $responseJson->setObj($candidates);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);

            /*$errorMsg = $candidateExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($candidateExc);
            Log::error($msg);*/

            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
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
        $responseJson = null;
        //dd('Inside candidate details controller');

        try
        {
            $candidateDetails = $this->candidateService->getCandidateDetails($candidateId);
            //dd($listGroups);
            if(!empty($candidateDetails))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_DETAILS_SUCCESS));

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_DETAILS_FOUND));
            }

            $responseJson->setObj($candidateDetails);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_DETAILS_ERROR));
            $responseJson->sendErrorResponse($candidateExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }

    public function applyForJob(Request $applyJobRequest)
    {
        $applyJobVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $applyJobVM = CandidateProfileMapper::setApplyJobDetails($applyJobRequest);
            //return $candidateProfileVM;
            $status = $this->candidateService->applyForJob($applyJobVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_APPLY_JOB_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
            else
            {
                $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_APPLY_JOB_ERROR));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_APPLY_JOB_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Get count of candidates
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidatesCount()
    {
        $candidateCount = null;
        $responseJson = null;
        //dd('Inside jobs details controller');

        try
        {
            $candidateCount = $this->candidateService->getCandidatesCount();

            if(!empty($candidateCount))
            {
                //dd('Inside if');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_COUNT_SUCCESS));
            }
            else
            {
                //dd('Inside else');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_COUNT_FOUND));
            }

            $responseJson->setObj($candidateCount);
            $responseJson->sendSuccessResponse();

        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $errorMsg = $candidateExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($candidateExc);
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

    /* Save candidate personal and job profile
     * @params $candidateRequest
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateProfile(Request $candidateRequest)
    {
        $candidateProfileVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $candidateProfileVM = CandidateProfileMapper::setCandidateProfile($candidateRequest);
            //return $candidateProfileVM;
            $status = $this->candidateService->saveCandidateProfile($candidateProfileVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PROFILE_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_PROFILE_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Save candidate skills
     * @params $candidateRequest
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateSkills(Request $candidateRequest)
    {
        $candidatesSkillVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            //return $candidateRequest->all();
            $candidatesSkillVM = CandidateProfileMapper::setCandidateSkills($candidateRequest);
            $status = $this->candidateService->saveCandidateSkills($candidatesSkillVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_SKILLS_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
            //dd($candidatesSkillVM->getCandidateSkills());

        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_SKILLS_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Save candidate employment details
     * @params $candidateRequest
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateEmployment(Request $candidateRequest)
    {
        $candidatesEmpVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            //dd($candidateRequest->all());
            $candidatesEmpVM = CandidateProfileMapper::setCandidateEmploymentDetails($candidateRequest);
            $status = $this->candidateService->saveCandidateEmployment($candidatesEmpVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_EMPLOYMENT_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_EMPLOYMENT_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Save candidate project details
     * @params $candidateRequest
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateProjects(Request $candidateRequest)
    {
        $candidateProjectsVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            //dd($candidateRequest->all());
            $candidateProjectsVM = CandidateProfileMapper::setCandidateProjectDetails($candidateRequest);
            $status = $this->candidateService->saveCandidateProjects($candidateProjectsVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PROJECTS_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_PROJECTS_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Save candidate preference details
     * @params $candidateRequest
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidatePreferences(Request $candidateRequest)
    {
        $candidatePreferencesVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            //dd($candidateRequest->all());
            $candidatePreferencesVM = CandidateProfileMapper::setCandidatePreferences($candidateRequest);
            $status = $this->candidateService->saveCandidatePreferences($candidatePreferencesVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PREFERENCES_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_PREFERENCES_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Save candidate other details
     * @params $candidateRequest
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateOtherDetails(Request $candidateRequest)
    {
        $candidateOtherDetailsVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            //dd($candidateRequest->all());
            $candidateOtherDetailsVM = CandidateProfileMapper::setCandidateOtherDetails($candidateRequest);
            $status = $this->candidateService->saveCandidateOtherDetails($candidateOtherDetailsVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_OTHER_DETAILS_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_OTHER_DETAILS_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Delete a candidate
     * @params $candidateId
     * @throws $candidateException
     * @return true | false
     * @author Baskar
     */

    public function deleteCandidate(Request $candidateRequest)
    {
        $candidateId = null;
        $jsonResponse = null;

        try
        {
            $candidateId = $candidateRequest->get('candidateId');
            $status = $this->candidateService->deleteCandidate($candidateId);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PROFILE_DELETE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }

        }
        catch(CandidateException $candidateExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_PROFILE_DELETE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
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
        $responseJson = null;
        //dd('Inside candidate details controller');

        try
        {
            $candidateSkills = $this->candidateService->getCandidateSkills($candidateId);
            //dd($listGroups);
            if(!empty($candidateSkills))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_SKILLS_LIST_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_SKILLS_NOT_FOUND));
            }

            $responseJson->setObj($candidateSkills);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_SKILLS_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
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
        $responseJson = null;
        //dd('Inside candidate details controller');

        try
        {
            $candidateEmployment = $this->candidateService->getCandidateEmployment($candidateId);
            //dd($listGroups);
            if(!empty($candidateEmployment))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_EMPLOYMENT_LIST_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_EMPLOYMENT_NOT_AVAILABLE));
            }

            $responseJson->setObj($candidateEmployment);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_EMPLOYMENT_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
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
        $responseJson = null;
        //dd('Inside candidate details controller');

        try
        {
            $candidateProjects = $this->candidateService->getCandidateProjects($candidateId);
            //dd($listGroups);
            if(!empty($candidateProjects))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PROJECTS_LIST_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PROJECTS_NOT_AVAILABLE));
            }

            $responseJson->setObj($candidateProjects);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_PROJECTS_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
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
        $responseJson = null;
        //dd('Inside candidate details controller');

        try
        {
            $candidatePreferences = $this->candidateService->getCandidatePreferences($candidateId);
            //dd($listGroups);
            if(!empty($candidatePreferences))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PREFERENCES_LIST_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_PREFERENCES_NOT_AVAILABLE));
            }

            $responseJson->setObj($candidatePreferences);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_PREFERENCES_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }

    /* Track job status
     * @params $jobStatusRequest
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function trackJobStatus(Request $jobStatusRequest)
    {
        $appliedJobs = null;
        $responseJson = null;
        $jobStatus = null;
        $trackStatusVM = null;

        try
        {
            $paginate = $jobStatusRequest->get('paginate');
            $trackStatusVM = new TrackStatusViewModel();
            $jobStatus = (object) $jobStatusRequest->all();
            $trackStatusVM->setCandidateId($jobStatus->candidateId);
            $trackStatusVM->setStatusId($jobStatus->jobStatus);

            $appliedJobs = $this->candidateService->trackJobStatus($trackStatusVM, $paginate);
            //dd($appliedJobs->items());
            if(!empty($appliedJobs->items()))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_TRACK_JOBSTATUS_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_TRACK_STATUS_FOUND));
            }

            $responseJson->setObj($appliedJobs);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_TRACK_JOBSTATUS_ERROR));
            $responseJson->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }


    /**
     * Web Login using Email, password and hospital
     * @param $loginRequest
     * @throws $candidateException
     * @return array | null
     * @author Vimal
     */

    public function CandidateLogin(Request $loginRequest)
    {
        $userSession = null;
        $responseJson = null;

        try
        {


            $credentials = $loginRequest->only('email', 'password');
            if ($token = JWTAuth::attempt($credentials))
            {
                $userSession=JWTAuth::toUser($token);
                $userSession->token=$token;


                if((Auth::user()->hasRole('Candidate')) &&  (Auth::user()->delete_status==1) ) {

                    //return Auth::user()->name;
                    //dd("OK");
                    $userSession->role="Candidate";

                    $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LOGIN_SUCCESS));
                    $responseJson->setObj($userSession);
                    $responseJson->sendSuccessResponse();
                }
                else
                {
                    Auth::logout();
                    Session::flush();

                    $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::USER_LOGIN_ERROR));
                    $responseJson->setObj($userSession);
                    $responseJson->sendSuccessResponse();
                }

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LOGIN_ERROR));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }

        }
        catch(CandidateException $candidateExc)
        {
           // dd($candidateExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_LOGIN_ERROR));
            $responseJson->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
           // dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);

        }

        return $responseJson;

    }

    /**
     * Web Login using Email, password and hospital
     * @param $loginRequest
     * @throws CandidateException
     * @return array | null
     * @author Vimal
     */

    public function CandidateForgotLogin(HelperService $helperService, Request $forgotloginRequest)
    {
        $email = null;
        $userSession = null;
        $responseJson = null;
        try
        {

            $email = $forgotloginRequest->email;
            $userSession = $helperService->ForgotLogin($email);


            if($userSession)
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_FORGOTLOGIN_SUCCESS));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_FORGOTLOGIN_ERROR));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }

        }
        catch(CandidateException $candidateExc)
        {
            // dd($candidateExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_FORGOTLOGIN_ERROR));
            $responseJson->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);

        }

        return $responseJson;

    }

    /**
     * Schedule interview for the candidates
     * @param $interviewRequest
     * @throws $companyException
     * @return array | null
     * @author Vimal
     */

    public function scheduleInterview(Request $interviewRequest)
    {
        $scheduleInterviewVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $candidateOtherDetailsVM = CandidateProfileMapper::setInterviewDetails($interviewRequest);
            $status = $this->candidateService->saveCandidateOtherDetails($candidateOtherDetailsVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_INTERVIEW_SCHEDULE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_INTERVIEW_SCHEDULE_ERROR));
            $jsonResponse->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;


    }


    /* Get list of getCandidatesByQuickSearch
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidatesByQuickSearch(Request $candidateRequest)
    {
        $candidates = null;
        $responseJson = null;
        //dd('Inside candidates list controller');

        try
        {
            $paginate = $candidateRequest->get('paginate');
            $candidates = $this->candidateService->getCandidates($paginate);
            //dd($candidates);
            if(!empty($candidates))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LIST_SUCCESS));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }
            else
            {
                //dd('Inside else statement');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_LIST_FOUND));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }

            $responseJson->setObj($candidates);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);

            /*$errorMsg = $candidateExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($candidateExc);
            Log::error($msg);*/

            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }


    /* Get list of getCandidatesByBasicSearch
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidatesByBasicSearch(Request $candidateRequest)
    {
        $candidates = null;
        $responseJson = null;
        //dd('Inside candidates list controller');

        try
        {
            $paginate = $candidateRequest->get('paginate');
            $candidates = $this->candidateService->getCandidates($paginate);
            //dd($candidates);
            if(!empty($candidates))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LIST_SUCCESS));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }
            else
            {
                //dd('Inside else statement');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_LIST_FOUND));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }

            $responseJson->setObj($candidates);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);

            /*$errorMsg = $candidateExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($candidateExc);
            Log::error($msg);*/

            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }


    /* Get list of getCandidatesByAdvanceSearch
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidatesByAdvanceSearch(Request $candidateRequest)
    {
        $candidates = null;
        $responseJson = null;
        //dd('Inside candidates list controller');

        try
        {
            $paginate = $candidateRequest->get('paginate');
            $candidates = $this->candidateService->getCandidates($paginate);
            //dd($candidates);
            if(!empty($candidates))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LIST_SUCCESS));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }
            else
            {
                //dd('Inside else statement');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_LIST_FOUND));
                //$responseJson->setObj($candidates);
                //$responseJson->sendSuccessResponse();
            }

            $responseJson->setObj($candidates);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($candidateExc);

            /*$errorMsg = $candidateExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($candidateExc);
            Log::error($msg);*/

            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_LIST_ERROR));
            $responseJson->sendErrorResponse($candidateExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }


    /* Get candidate details
     * @params $companyId
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCandidateDetailsBySearch($candidateId)
    {
        $candidateDetails = null;
        $responseJson = null;
        //dd('Inside candidate details controller');

        try
        {
            $candidateDetails = $this->candidateService->getCandidateDetails($candidateId);
            //dd($listGroups);
            if(!empty($candidateDetails))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_DETAILS_SUCCESS));

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CANDIDATE_DETAILS_FOUND));
            }

            $responseJson->setObj($candidateDetails);
            $responseJson->sendSuccessResponse();
        }
        catch(CandidateException $candidateExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_DETAILS_ERROR));
            $responseJson->sendErrorResponse($candidateExc);

        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $responseJson;
    }


}
