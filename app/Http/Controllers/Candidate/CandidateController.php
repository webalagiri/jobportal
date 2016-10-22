<?php

namespace App\Http\Controllers\Candidate;

use App\jobportal\mapper\CandidateProfileMapper;
use App\jobportal\services\CandidateService;
use App\jobportal\utilities\Exception\CandidateException;
use App\jobportal\utilities\Exception\AppendMessage;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\jobportal\common\ResponseJson;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;

use Exception;
use Log;

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

    public function getCandidates()
    {
        $candidates = null;
        $responseJson = null;
        //dd('Inside candidates list controller');

        try
        {
            $candidates = $this->candidateService->getCandidates();
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
}
