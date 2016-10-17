<?php
/**
 * Created by PhpStorm.
 * User: vistara1
 * Date: 10/6/16
 * Time: 3:40 PM
 */

namespace App\jobportal\common;

//use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\jobportal\utilities\Exception\BaseException;
use App\jobportal\utilities\Exception\AppendMessage;
use Log;

//class ResponseJSON extends Response {
class ResponseJson extends JsonResponse {

    private $obj;
    private $result;
    private $message;
    private $httpCode;

    const HTTP_SUCCESS_STATUS = 200;

    public function __construct($result, $message = null)
    {
        $this->result = $result;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;

    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param mixed $httpCode
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }


    /**
     * @return mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * @param mixed $obj
     */
    public function setObj($obj)
    {
        $this->obj = $obj;

        //dd($obj);
        /*try{
            $this->obj = $obj;
            parent::__construct($obj, 422);
        }
        catch(\Exception $exc)
        {
            dd($exc);
        }*/

    }

    public function sendSuccessResponse()
    {
        $data = array(
            'isSuccess' => $this->result,
            'message' => $this->getMessage(),
            'status' => $this::HTTP_SUCCESS_STATUS,
            'result' => $this->obj
        );

        parent::__construct($data, $this::HTTP_SUCCESS_STATUS);
    }

    public function sendErrorResponse(BaseException $exc)
    {
        $data = array(
            'isSuccess' => $this->result,
            'message' => $this->getMessage(),
            'status' => $this::HTTP_SUCCESS_STATUS,
        );
        //dd('Inside send error response');
        $errorMsg = $exc->getMessageForCode();
        $msg = AppendMessage::appendMessage($exc);
        Log::error($msg);

        parent::__construct($data, $this::HTTP_SUCCESS_STATUS);

        /*$data = array(
            'isSuccess' => $this->result,
            'result' => $this->obj
        );

        try{
            parent::__construct($data, 422);
            //parent::
        }
        catch(\Exception $exc)
        {
            dd($exc);
        }*/

        //dd($data);


    }

    /*public function jsonSerialize()
    {
        //dd($this->obj);
        return $this->getObj();
    }*/


}