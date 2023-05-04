<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedException) {
            return response()->json([
                'message' => 'You do not have the required authorization.',
                'status'  => 403,
            ], 403);
        } elseif ($exception instanceof QueryException) {
            return $this->handleQueryException($exception);
        } elseif ($exception instanceof AuthenticationException) {
            return $this->handleAuthenticationException($exception);
        } elseif ($exception instanceof ValidationException) {
            return $this->handleValidationException($exception);
        } elseif ($exception instanceof AuthorizationException) {
            return $this->handleAuthorizationException($exception);
        } elseif ($exception instanceof ModelNotFoundException) {
            return $this->handleModelNotFoundException($exception);
        } else {
            return $this->handleException($exception);
        }

        return parent::render($request, $exception);
    }


    protected function handleQueryException(QueryException $exception)
    {
        $errorCode = $exception->errorInfo[1];
        if ($errorCode == 1062) {
            return response()->json(['error' => 'Duplicate entry. ' . $exception->getMessage()], 422);
        } elseif ($errorCode == 1452) {
            return response()->json(['error' => 'Foreign key constraint. ' . $exception->getMessage()], 422);
        } else {
            return response()->json(['error' => 'Database error. ' . $exception->getMessage()], 500);
        }
    }

    protected function handleAuthenticationException(AuthenticationException $exception)
    {
        return response()->json(['error' => $exception->getMessage()], 401);
    }

    protected function handleValidationException(ValidationException $exception)
    {
        return response()->json(['error' => $exception->validator->errors()], 422);
    }

    protected function handleAuthorizationException(AuthorizationException $exception)
    {
        return response()->json(['error' => $exception->getMessage()], 403);
    }

    protected function handleModelNotFoundException(ModelNotFoundException $exception)
    {
        return response()->json(['error' => $exception->getMessage()], 404);
    }

    protected function handleException(Exception $exception, $statusCode = 500)
    {
        return response()->json(['error' => $exception->getMessage()], $exception->getCode() ?: $statusCode);
    }
}
