<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\RequestTrait;
use App\Traits\ResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
    
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->badRequest($exception->errors(), $request->all(), false);
        }

        return parent::render($request, $exception);
    }


    // Return a proper JSON response once access token is invalid.
    protected function unauthenticated($request, AuthenticationException $exception) 
    {
        if ($request->expectsJson()) {
            return $this->unauthorized('Invalid access token!', $request->all(), false);
        }

        return redirect()->guest('login');
    }
}
