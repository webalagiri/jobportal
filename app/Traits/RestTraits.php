<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/14/2016
 * Time: 2:56 PM
 */

namespace App\Traits;

use Illuminate\Http\Request;


trait RestTraits
{
    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api/v'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/api/') !== false;
    }
}