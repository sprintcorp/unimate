<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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

        });

        $this->renderable(function (ValidationException $e) {
            return $this->convertValidationExceptionToResponse($e, request());
        });

        $this->renderable(function (QueryException $e) {
            return response()->json(['error' =>$e->getMessage(),'code'=>500], 500);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e) {
            return response()->json(['error' =>$e->getMessage(),'code'=>405], 405);
        });

        $this->renderable(function (AuthenticationException $e) {
            return response()->json(['error' => 'unauthenticated','code'=>401], 401);
        });

        $this->reportable(function (RouteNotFoundException $e) {
            return response()->json(['error' =>$e->getMessage(),'code'=>404], 404);
        });
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return response()->json(['error'=>$errors],422);
    }
}
