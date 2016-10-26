<?php

namespace App\Http\Controllers\Common;

use App\jobportal\common\ResponseJson;
use App\jobportal\services\HelperService;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\HelperException;
use App\jobportal\utilities\Exception\AppendMessage;

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
        return Response()->download($filefullpath);

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
        //return $loginRequest->password;
        //$loginInfo = $loginRequest->all();
        //$loginInfo = $loginRequest;
        //return  $loginRequest->get('email');
        //dd($loginInfo);
        $userSession = null;
        $responseJson = null;
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

                if((Auth::user()->hasRole('Admin')) &&  (Auth::user()->delete_status==1) ) {

                    //return Auth::user()->name;
                    //dd("OK");
                    $userSession->role="Admin";
                }
                else if((Auth::user()->hasRole('Client')) &&  (Auth::user()->delete_status==1) ) {

                    //return Auth::user()->name;
                    //dd("OK");
                    $userSession->role="Client";
                }
                else if((Auth::user()->hasRole('Candidate')) &&  (Auth::user()->delete_status==1) ) {

                    //return Auth::user()->name;
                    //dd("OK");
                    $userSession->role="Candidate";
                }

                if( (Auth::user()->delete_status==1) )
                {

                    $responseJson = new ResponseJson(ErrorEnum::SUCCESS, trans('messages.'.ErrorEnum::USER_LOGIN_SUCCESS));
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
        //return $forgotloginRequest->email;
        //$loginInfo = $loginRequest->all();
        $loginInfo = $forgotloginRequest;
        //return  $loginRequest->get('email');
        //dd($loginInfo);
        $email = null;
        $userSession = null;
        //$candidateRequest->get('candidateId');

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




}
