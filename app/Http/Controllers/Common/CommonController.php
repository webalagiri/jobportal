<?php

namespace App\Http\Controllers\Common;

use App\jobportal\common\ResponseJson;
use App\jobportal\services\HelperService;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\HelperException;
use App\jobportal\utilities\Exception\AppendMessage;
use App\jobportal\mapper\ListGroupMapper;
use App\jobportal\mapper\ListEntityMapper;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;
use Log;
use App;
use Response;
use Excel;

use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    protected $commonService;

    public function __construct(HelperService $helperService)
    {
        $this->commonService = $helperService;
    }

    /* Get list groups
     * @params none
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListGroups()
    {
        $listGroups = null;
        $responseJson = null;
        //dd('Inside list groups controller');

        try
        {
            $listGroups = $this->commonService->getListGroups();
            //dd($listGroups);
            if(!is_null($listGroups) && count($listGroups > 0))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::LIST_GROUP_SUCCESS));
                $responseJson->setObj($listGroups);
                $responseJson->sendSuccessResponse();
            }
        }
        catch(HelperException $helperExc)
        {
            //dd($helperExc);
            $errorMsg = $helperExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($helperExc);
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

    /* Get all list entities
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getListEntities()
    {
        $listEntities = null;
        $responseJson = null;
        //dd('Inside list entities controller');

        try
        {
            $listEntities = $this->commonService->getListEntities();
            //dd($listGroups);
            /*if(!is_null($listEntities) && count($listEntities > 0))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::LIST_ENTITY_SUCCESS));
                $responseJson->setObj($listEntities);
                $responseJson->sendSuccessResponse();
            }*/

            if(!empty($listEntities))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::LIST_ENTITY_SUCCESS));

            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_LIST_ENTITY_FOUND));
            }

            $responseJson->setObj($listEntities);
            $responseJson->sendSuccessResponse();
        }
        catch(HelperException $helperExc)
        {
            //dd($helperExc);
            $errorMsg = $helperExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($helperExc);
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

    /* Get list entity data by group Id
     * @params $groupId
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListEntityByGroupId($groupId)
    {
        $listEntities = null;
        $responseJson = null;
        //dd($groupId);

        try
        {
            $listEntities = $this->commonService->getListEntityByGroupId($groupId);
            //dd($listGroups);
            if(!is_null($listEntities) && count($listEntities > 0))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::LIST_ENTITY_SUCCESS));
                $responseJson->setObj($listEntities);
                $responseJson->sendSuccessResponse();
            }
        }
        catch(HelperException $helperExc)
        {
            //dd($helperExc);
            $errorMsg = $helperExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($helperExc);
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

    /* Get list entity by parent Id
     * @params $parentId
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListEntityByParentId($parentId)
    {
        $listEntities = null;
        $responseJson = null;
        //dd($groupId);

        try
        {
            $listEntities = $this->commonService->getListEntityByParentId($parentId);
            //dd($listGroups);
            //if(!is_null($listEntities) && count($listEntities > 0))
            if(!empty($listEntities->items()))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::LIST_ENTITY_SUCCESS));
            }
            else
            {
                //dd('Inside else');
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_LIST_ENTITY_FOUND));
            }

            $responseJson->setObj($listEntities);
            $responseJson->sendSuccessResponse();
        }
        catch(HelperException $helperExc)
        {
            //dd($helperExc);
            $errorMsg = $helperExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($helperExc);
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

    /* Delete list group
     * @params $deleteGroupRequest
     * @throws $helperExc
     * @return true | false
     * @author Baskar
     */

    public function deleteListGroup(Request $deleteGroupRequest)
    {
        $listGroupId = null;
        $jsonResponse = null;

        try
        {
            $listGroupId = $deleteGroupRequest->get('groupId');
            //$status = $this->commonService->deleteListGroup($listGroupId);

            /*if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COMPANY_PROFILE_DELETE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }*/

        }
        catch(HelperException $helperExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::COMPANY_PROFILE_DELETE_ERROR));
            $jsonResponse->sendErrorResponse($helperExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Get the list of cities
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getCities()
    {
        $cities = null;
        $responseJson = null;
        //dd('Inside list entities controller');

        try
        {
            $cities = $this->commonService->getCities();

            if(!empty($cities))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CITY_LIST_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_CITY_LIST_FOUND));
            }

            $responseJson->setObj($cities);
            $responseJson->sendSuccessResponse();
        }
        catch(HelperException $helperExc)
        {
            //dd($helperExc);
            $errorMsg = $helperExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($helperExc);
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

    /* Get the list of countries
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getCountries()
    {
        $countries = null;
        $responseJson = null;
        //dd('Inside list entities controller');

        try
        {
            $countries = $this->commonService->getCountries();

            if(!empty($countries))
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::COUNTRY_LIST_SUCCESS));
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NO_COUNTRY_LIST_FOUND));
            }

            $responseJson->setObj($countries);
            $responseJson->sendSuccessResponse();
        }
        catch(HelperException $helperExc)
        {
            //dd($helperExc);
            $errorMsg = $helperExc->getMessageForCode();
            $msg = AppendMessage::appendMessage($helperExc);
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

    /* Save new list group
     * @params $listGroupRequest
     * @throws HelperException
     * @return true | false
     * @author Baskar
     */

    public function saveListGroups(Request $listGroupRequest)
    {
        $listGroupVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $listGroupVM = ListGroupMapper::setListGroup($listGroupRequest);

            $status = $this->commonService->saveListGroups($listGroupVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NEW_LIST_GROUP_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(HelperException $helperExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::NEW_LIST_GROUP_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($helperExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    /* Save new list entity
     * @params $listEntityRequest
     * @throws HelperException
     * @return true | false
     * @author Baskar
     */

    public function saveListEntity(Request $listEntityRequest)
    {
        $listEntityVM = null;
        $status = true;
        $jsonResponse = null;

        try
        {
            $listEntityVM = ListEntityMapper::setListEntity($listEntityRequest);

            $status = $this->commonService->saveListEntity($listEntityVM);

            if($status)
            {
                $jsonResponse = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::NEW_LIST_GROUP_SAVE_SUCCESS));
                $jsonResponse->sendSuccessResponse();
            }
        }
        catch(HelperException $helperExc)
        {
            $jsonResponse = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::NEW_LIST_GROUP_SAVE_ERROR));
            $jsonResponse->sendErrorResponse($helperExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);
        }

        return $jsonResponse;
    }

    public function generatePDF()
    {
    /*
        $pdf = App::make('snappy.pdf');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->inline();
    */

        $snappy = App::make('snappy.pdf');
//To file
        $html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
        $resumeurl='http://localhost/jobportal/public/resume#/signup';
        $filename = 'resume-'.time().'.pdf';
        $filefullpath = 'd:/tmp/'.$filename;
        //$snappy->generateFromHtml($html, $filefullpath);
        //$snappy->generate('http://www.github.com', 'd:/tmp/github-'.time().'.pdf');
        $snappy->generate($resumeurl, $filefullpath);

        //return $snappy->download($file);

//Or output:
        /*
        return Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'"'
            )
        );
        */
        //return Response()->download($filefullpath);

        return Response(
            $snappy->generate($resumeurl, $filefullpath),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'"'
            )
        );
        /*
         return PDF::loadFile('http://www.getkyr.com')->inline('getkyr-'.time().'.pdf');
        */
    }


    public function downloadFile()
    {
        $snappy = App::make('snappy.pdf');

//To file

        $html = '<h1>RESUME</h1><p>RESUME DOWNLOAD.</p>';
        $filename = 'resume-'.time().'.pdf';

//Or output:

        return Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'"'
            )
        );

    }

    public function importEXCEL()
    {

        Excel::load('excel/company.xls', function($reader) {

            /*
            // Getting all results
            $results = $reader->get();
            dd($results);
            */

            /*
            // ->all() is a wrapper for ->get() and will work the same
            $results = $reader->all();
            dd($results);
            */

            $results = $reader->toArray();
            dd($results[0]);

            foreach($reader as $sheet)
            {
                // get sheet title
                //$sheetTitle = $sheet->getTitle();
                $sheetData = $sheet->getTitle();
                dd($sheetData);
            }

        });

    }




    /**
     * Web Login using Email, password and hospital
     * @param $loginRequest
     * @throws $candidateException
     * @return array | null
     * @author Vimal
     */

    public function Login(Request $loginRequest)
    {
        $userSession = null;
        $responseJson = null;

        try
        {


            if (Auth::attempt(['email' => $loginRequest->email, 'password' => $loginRequest->password]))
            {
                $userSession=Auth::user();

                if((Auth::user()->hasRole('Admin')) &&  (Auth::user()->delete_status==1) ) {

                    //return Auth::user()->name;
                    //dd("OK");
                    $userSession->role="Admin";

                    $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LOGIN_SUCCESS));
                    $responseJson->setObj($userSession);
                    $responseJson->sendSuccessResponse();
                }
                else if((Auth::user()->hasRole('Client')) &&  (Auth::user()->delete_status==1) ) {

                    //return Auth::user()->name;
                    //dd("OK");
                    $userSession->role="Client";

                    $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CANDIDATE_LOGIN_SUCCESS));
                    $responseJson->setObj($userSession);
                    $responseJson->sendSuccessResponse();
                }
                else if((Auth::user()->hasRole('Candidate')) &&  (Auth::user()->delete_status==1) ) {

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
        catch(HospitalException $commonExc)
        {
             dd($commonExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_LOGIN_ERROR));
            $responseJson->sendErrorResponse($commonExc);
        }
        catch(Exception $exc)
        {
             dd($exc);
            $msg = AppendMessage::appendGeneralException($exc);
            Log::error($msg);

        }

        return $responseJson;

    }


    /**
     * Web Login using Email, password and hospital
     * @param $loginRequest
     * @throws $commonException
     * @return array | null
     * @author Vimal
     */

    public function ForgotLogin(Request $forgotloginRequest)
    {
        $email = null;
        $userSession = null;

        try
        {

            $email = $forgotloginRequest->email;
            $userSession = $this->commonService->ForgotLogin($email);

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
        catch(HospitalException $commonExc)
        {
            // dd($candidateExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_FORGOTLOGIN_ERROR));
            $responseJson->sendErrorResponse($commonExc);
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
     * ChangePassword
     * @param $passwordRequest
     * @throws $commonException
     * @return array | null
     * @author Vimal
     */

    public function ChangePassword(Request $passwordRequest)
    {

        $userSession = null;

        try
        {

            $userId = $passwordRequest->user_id;
            $oldPassword = $passwordRequest->old_password;
            $newPassword = $passwordRequest->new_password;
            $confirmPassword = $passwordRequest->confirm_password;

            if($newPassword==$confirmPassword)
            {
                $userSession = $this->commonService->ChangePassword($passwordRequest);
            }


            if($userSession)
            {
                $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::CHANGE_PASSWORD_SUCCESS));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }
            else
            {
                $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CHANGE_PASSWORD_ERROR));
                $responseJson->setObj($userSession);
                $responseJson->sendSuccessResponse();
            }

        }
        catch(HospitalException $commonExc)
        {
            // dd($candidateExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::CANDIDATE_FORGOTLOGIN_ERROR));
            $responseJson->sendErrorResponse($commonExc);
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
     * @throws $candidateException
     * @return array | null
     * @author Vimal
     */

    public function Logout(Request $logoutRequest)
    {
        $userSession = null;
        $responseJson = null;

        try
        {

            Auth::logout();
            Session::flush();

            $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::USER_LOGOUT_SUCCESS));
            $responseJson->setObj($userSession);
            $responseJson->sendSuccessResponse();


        }
        catch(HospitalException $commonExc)
        {
            //dd($commonExc);
            $responseJson = new ResponseJson(ErrorEnum::FAILURE, trans('messages.'.ErrorEnum::USER_LOGOUT_ERROR));
            $responseJson->sendErrorResponse($commonExc);
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
