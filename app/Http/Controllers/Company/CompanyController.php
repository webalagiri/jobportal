<?php

namespace App\Http\Controllers\Company;

use App\jobportal\common\ResponseJson;
use App\jobportal\mapper\CompanyProfileMapper;
use App\jobportal\services\CompanyService;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\CompanyException;
use App\jobportal\utilities\Exception\AppendMessage;
use Illuminate\Http\Request;

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

    public function getCompanyList()
    {
        $companies = null;
        $responseJson = null;
        //dd('Inside companies list controller');

        try
        {
            $companies = $this->companyService->getCompanyList();
            //dd($listGroups);
            if(!is_null($companies) && count($companies > 0))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_LIST_SUCCESS));
                $responseJson->setObj($companies);
                $responseJson->sendSuccessResponse();
            }
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
            if(!is_null($companyDetails) && count($companyDetails > 0))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_DETAILS_SUCCESS));
                $responseJson->setObj($companyDetails);
                $responseJson->sendSuccessResponse();
            }
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


    /**
     * Web Login using Email, password and hospital
     * @param $loginRequest
     * @throws $companyException
     * @return array | null
     * @author Vimal
     */

    public function CompanyLogin(Request $loginRequest)
    {
        //return $loginRequest->password;
        //$loginInfo = $loginRequest->all();
        //$loginInfo = $loginRequest;
        //return  $loginRequest->get('email');
        //dd($loginInfo);
        $userSession = null;
        //$candidateRequest->get('candidateId');

        try
        {


            if (Auth::attempt(['email' => $loginRequest->email, 'password' => $loginRequest->password]))
            {
                $userSession=Auth::user();
                // return $userSession;
                /*
                $userSession = new UserSession();
                $userSession->setLoginUserId(Auth::user()->id);

                $userSession->setDisplayName(ucfirst(Auth::user()->name));
                $userSession->setLoginUserType(UserType::USERTYPE_CANDIDATE);
                $userSession->setAuthDisplayName(ucfirst(Auth::user()->name));

                return $userSession;
                */
                /*
                //dd(Auth::user());
                Session::put('loggedUser', $userSession);
                $DisplayName=Session::put('DisplayName', ucfirst(Auth::user()->name));
                $LoginUserId=Session::put('LoginUserId', Auth::user()->id);
                $DisplayName=Session::put('DisplayName', ucfirst(Auth::user()->name));
                $AuthDisplayName=Session::put('AuthDisplayName', ucfirst(Auth::user()->name));
                $AuthDisplayPhoto=Session::put('AuthDisplayPhoto', "no-image.jpg");
                */

                // if((Auth::user()->hasRole('Candidate')) &&  (Auth::user()->delete_status==1) ) {}

                if( (Auth::user()->delete_status==1) )
                {

                    $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_LOGIN_SUCCESS));
                    $responseJson->setObj($userSession);
                    $responseJson->sendSuccessResponse();
                }
                else
                {
                    Auth::logout();
                    Session::flush();

                    $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_LOGIN_ERROR));
                    $responseJson->setObj($userSession);
                    $responseJson->sendSuccessResponse();
                }

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_LOGIN_ERROR));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }

        }
        catch(HospitalException $companyExc)
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


    /**
    * Web Login using Email, password and hospital
    * @param $loginRequest
    * @throws $companyException
    * @return array | null
    * @author Vimal
    */

    public function CompanyForgotLogin(Request $forgotloginRequest)
    {
        //return $forgotloginRequest->email;
        //$loginInfo = $loginRequest->all();
        $loginInfo = $forgotloginRequest;
        //return  $loginRequest->get('email');
        //dd($loginInfo);
        $userSession = null;
        //$candidateRequest->get('candidateId');

        try
        {

            $userSession = User::where('email', '=', $forgotloginRequest->email)->first();

            if($userSession)
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_FORGOTLOGIN_SUCCESS));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_FORGOTLOGIN_ERROR));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }

        }
        catch(HospitalException $companyExc)
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
