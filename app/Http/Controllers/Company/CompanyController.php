<?php

namespace App\Http\Controllers\Company;

use App\jobportal\common\ResponseJson;
use App\jobportal\services\CompanyService;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\CompanyException;
use App\prescription\utilities\Exception\AppendMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use Log;

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
}
