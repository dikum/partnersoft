<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException)
            $this->convertValidationExceptionToResponse($exception, $request);

        if($exception instanceof ModelNotFoundException)
        {
            $modelName = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("Sorry, the resource {$modelName} you are looking for does not exist", 404);
        }

        if($exception instanceof AuthenticationException)
            $this->unauthenticated($request, $exception);

        if($exception instanceof AuthorizationException)
            return $this->errorResponse($exception->getMessage(), 403);

        if($exception instanceof NotFoundHttpException)
            return $this->errorResponse("The specified URL does not exist", 404);

        if($exception instanceof MethodNotAllowedHttpException)
            return $this->errorResponse("The specified request method is invalid", 405);

        if($exception instanceof HttpException)
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());

        if($exception instanceof QueryException)
        {
            //dd($exception);
            $errorCode = $exception->errorInfo[1];
            if($errorCode == 1451)
            {
                return $this->errorResponse("The resource you are trying to remove is related to other resource(s)", 409);
            }
        }

        return parent::render($request, $exception);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        return $this->errorResponse($errors, 422);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse("Sorry, you are not authenticated", 401);
    }
}
