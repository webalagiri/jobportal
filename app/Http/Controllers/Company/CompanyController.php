<?php

namespace App\Http\Controllers\Company;

use App\Http\ViewModels\ManageInterviewViewModel;
use App\jobportal\common\ResponseJson;
use App\jobportal\mapper\CompanyProfileMapper;
use App\jobportal\services\CompanyService;
use App\jobportal\services\HelperService;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\CompanyException;
use App\jobportal\utilities\Exception\AppendMessage;
use Illuminate\Http\Request;

use JWTAuth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\jobportal\common\UserSession;
use App\jobportal\utilities\UserType;
use Exception;
use Log;
use App\User;

use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /* Get list of companies
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCompanyList(Request $jobRequest)
    {
        $companies = null;
        $responseJson = null;
        $sortBy = null;
        $paginate = null;
        //dd('Inside companies list controller');

        try
        {
            if($jobRequest->has('sortBy'))
            {
                $sortBy = $jobRequest->get('sortBy');
            }

            if($jobRequest->has('paginate'))
            {
                $paginate = $jobRequest->get('paginate');
            }

            //dd($paginate);

            $companies = $this->companyService->getCompanyList($paginate, $sortBy);
            //dd($listGroups);
            /*if(!is_null($companies) && count($companies > 0))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_LIST_SUCCESS));
                $responseJson->setObj($companies);
                $responseJson->sendSuccessResponse();
            }*/

            if(!empty($companies))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_LIST_SUCCESS));

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_COMPANY_LIST_FOUND));
            }

            $responseJson->setObj($companies);
            $responseJson->sendSuccessResponse();
        }
        catch(CompanyException $companyExc)
        {
            //dd($helperExc);
            $errorMsg = $companyExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($companyExc);
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

    /* Get company details
     * @params $companyId
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCompanyDetails($companyId)
    {
        $companyDetails = null;
        $responseJson = null;
        //dd('Inside companies details controller');

        try
        {
            $companyDetails = $this->companyService->getCompanyDetails($companyId);
            //dd($listGroups);
            /*if(!is_null($companyDetails) && count($companyDetails > 0))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_DETAILS_SUCCESS));
                $responseJson->setObj($companyDetails);
                $responseJson->sendSuccessResponse();
            }*/

            if(!empty($companyDetails))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_DETAILS_SUCCESS));

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_DETAILS_ERROR));
            }

            $responseJson->setObj($companyDetails);
            $responseJson->sendSuccessResponse();
        }
        catch(CompanyException $companyExc)
        {
            //dd($helperExc);
            $errorMsg = $companyExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($companyExc);
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

    /* Get list of latest jobs
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getLatestJobs()
    {
        $latestJobs = null;
        $responseJson = null;
        //dd('Inside jobs details controller');

        try
        {
            $latestJobs = $this->companyService->getLatestJobs();
            //dd($latestJobs->items());

            if(!empty($latestJobs->items()))
            {
                //dd('Inside if');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::JOB_LIST_SUCCESS));
                $responseJson->setObj($latestJobs);
            }
            else
            {
                //dd('Inside else');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_JOB_LIST_FOUND));
            }

            $responseJson->sendSuccessResponse();

        }
        catch(CompanyException $companyExc)
        {
            //dd($helperExc);
            $errorMsg = $companyExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($companyExc);
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

    /* Get count of companies
    * @params none
    * @throws $companyExc
    * @return array | null
    * @author Baskar
    */

    public function getCompanyCount()
    {
        $companyCount = null;
        $responseJson = null;
        //dd('Inside jobs details controller');

        try
        {
            $companyCount = $this->companyService->getCompanyCount();
            //dd($companyCount->items());
            //dd($latestJobs->items());

            if(!empty($companyCount))
            {
                //dd('Inside if');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_COUNT_SUCCESS));
            }
            else
            {
                //dd('Inside else');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_COMPANY_COUNT_FOUND));
            }

            $responseJson->setObj($companyCount);
            $responseJson->sendSuccessResponse();

        }
        catch(CompanyException $companyExc)
        {
            //dd($helperExc);
            $errorMsg = $companyExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($companyExc);
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

    /* Get list of industries
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getIndustries()
    {
        $industries = null;
        $responseJson = null;
        //dd('Inside companies list controller');

        try
        {
            $industries = $this->companyService->getIndustries();
            //dd($listGroups);

            if(!empty($industries))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::INDUSTRY_LIST_SUCCESS));

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_INDUSTRY_LIST_FOUND));
            }

            $responseJson->setObj($industries);
            $responseJson->sendSuccessResponse();
        }
        catch(CompanyException $companyExc)
        {
            //dd($helperExc);
            $errorMsg = $companyExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($companyExc);
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

    /* Get list of industries
     * @params none
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getFunctionalAreas()
    {
        $functionalAreas = null;
        $responseJson = null;
        //dd('Inside companies list controller');

        try
        {
            $functionalAreas = $this->companyService->getFunctionalAreas();
            //dd($listGroups);

            if(!empty($functionalAreas))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::FUNCTIONAL_AREAS_LIST_SUCCESS));

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_FUNCTIONAL_AREAS_LIST_FOUND));
            }

            $responseJson->setObj($functionalAreas);
            $responseJson->sendSuccessResponse();
        }
        catch(CompanyException $companyExc)
        {
            //dd($helperExc);
            $errorMsg = $companyExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($companyExc);
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

    /* Save company profile
     * @params $companyRequest
     * @throws $companyExc
     * @return true | false
     * @author Baskar
     */

    public function saveCompanyProfile(Request $companyRequest)
    {
        $companyProfileVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $companyProfileVM = CompanyProfileMapper::setCompanyProfile($companyRequest);

            $status = $this->companyService->saveCompanyProfile($companyProfileVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_PROFILE_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CompanyException $companyExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_PROFILE_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($companyExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Delete a company
     * @params $companyRequest
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function deleteCompany(Request $companyRequest)
    {
        //$status = true;
        $companyId = null;
        $jsonResponse = null;

        try
        {
            $companyId = $companyRequest->get('companyId');
            $status = $this->companyService->deleteCompany($companyId);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_PROFILE_DELETE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }

        }
        catch(CompanyException $companyExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_PROFILE_DELETE_ERROR));
            $jsonResponse->sendErrorResponse($companyExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }


    /* Register company
     * @params $companyRequest
     * @throws $companyExc
     * @return true | false
     * @author Baskar
     */

    public function CompanyRegister(Request $companyRequest)
    {

        $companyProfileVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $companyProfileVM = CompanyProfileMapper::setCompanyProfile($companyRequest);

            $status = $this->companyService->saveCompanyProfile($companyProfileVM);

            if($status[0])
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_PROFILE_SAVE_SUCCESS));
                $jsonResponse->setObj($status[1]);
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(CompanyException $companyExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_PROFILE_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($companyExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /**
     * Web Login using Email, password and hospital
     * @param $loginRequest
     * @throws $companyException
     * @return array | null
     * @author Vimal
     */

    public function CompanyLogin(Request $loginRequest)
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

                if((Auth::user()->hasRole('Client')) &&  (Auth::user()->delete_status==1) ) {

                    //return Auth::user()->name;
                    //dd("OK");
                    $userSession->role="Client";

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
        catch(CompanyException $companyExc)
        {
            // dd($candidateExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_LOGIN_ERROR));
            $responseJson->sendErrorResponse($companyExc);
        }
        catch(Exception $exc)
        {
            // dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);

        }

        return $responseJson;

    }

    /* Get list of interview list
     * @params $interviewVM
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getInterviewList(Request $interviewRequest)
    {
        $interviewList = null;
        $responseJson = null;
        $interviews = null;
        $interviewsVM = null;

        try
        {
            $paginate = $interviewRequest->get('paginate');
            $interviewsVM = new ManageInterviewViewModel();
            $interviews = (object) $interviewRequest->all();
            $interviewsVM->setJobId($interviews->jobId);
            $interviewsVM->setFilterId($interviews->jobFilter);

            $interviewList = $this->companyService->getInterviewList($interviewsVM, $paginate);

            if(!empty($interviewList->items()))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_INTERVIEW_LIST_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_INTERVIEW_LIST_FOUND));
            }

            $responseJson->setObj($interviewList);
            $responseJson->sendSuccessResponse();
        }
        catch(CompanyException $companyExc)
        {
            //dd($helperExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_INTERVIEW_LIST_ERROR));
            $responseJson->sendErrorResponse($companyExc);
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
    * @throws $companyException
    * @return array | null
    * @author Vimal
    */

    public function CompanyForgotLogin(HelperService $helperService, Request $forgotloginRequest)
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
        catch(CompanyException $companyExc)
        {
            // dd($candidateExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_FORGOTLOGIN_ERROR));
            $responseJson->sendErrorResponse($companyExc);
        }
        catch(Exception $exc)
        {
            // dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);

        }

        return $responseJson;

    }
}
