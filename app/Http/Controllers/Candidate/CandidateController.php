<?php

namespace App\Http\Controllers\Candidate;

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
}
