<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use App\Traits\RestExceptionHandlerTrait;
use App\Traits\RestTraits;

class Handler extends ExceptionHandler
{
    use RestTraits;
    use RestExceptionHandlerTrait;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        //dd($request->getUri());
        //dd($e);
        if(!$this->isApiCall($request)) {
            $retval = parent::render($request, $e);
        } else {
            $retval = $this->getJsonResponseForException($request, $e);
        }

        if($e instanceof TokenExpiredException)
        {
            return response()->json('Token Expired. Please try to login again', $e->getStatusCode());
        }
        else if($e instanceof TokenInvalidException)
        {
            return response()->json(['Invalid Token'], $e->getStatusCode());
        }

        return $retval;

        //return parent::render($request, $e);
    }
}
