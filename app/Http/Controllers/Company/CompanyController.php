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
}
