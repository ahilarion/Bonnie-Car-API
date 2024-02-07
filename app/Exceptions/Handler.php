<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\QueryBuilder\Exceptions\InvalidIncludeQuery;
use Spatie\QueryBuilder\QueryBuilderRequest;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (MethodNotAllowedException $e, $request) {
            return response()->json(['message' => 'Route not found'], 404);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json(['message' => 'Route not found'], 404);
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        });

        $this->renderable(function (FatalError $e, $request) {
            if (str_contains($e->getMessage(), 'Allowed memory size')) {
                return response()->json(['message' => 'Memory size exceeded'], 500);
            }

            return response()->json(['message' => 'Internal server error'], 500);
        });

        $this->renderable(function (InvalidIncludeQuery $e, $request) {
            return response()->json(['message' => 'Invalid include query'], 400);
        });
    }
}
