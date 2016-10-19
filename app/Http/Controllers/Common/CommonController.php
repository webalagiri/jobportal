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
        $filename = 'bill-123-'.time().'.pdf';
        $filefullpath = 'd:/tmp/'.$filename;
        $snappy->generateFromHtml($html, $filefullpath);
        //$snappy->generate('http://www.github.com', 'd:/tmp/github-'.time().'.pdf');
        //return $snappy->download($file);

//Or output:

        return Response(
            $snappy->getOutputFromHtml($html),
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

}
