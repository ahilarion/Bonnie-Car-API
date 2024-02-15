<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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

        //handle not connected user
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json(['error' => 'Unauthenticated'], Response::HTTP_UNAUTHORIZED);
        });

        //   handle route not found
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json(['error' => 'Route not found'], Response::HTTP_NOT_FOUND);
        });

        $this->renderable(function (RouteNotFoundException $e, $request) {
            return response()->json(['error' => 'Route not found'], Response::HTTP_NOT_FOUND);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json(['error' => 'Method not allowed'], Response::HTTP_METHOD_NOT_ALLOWED);
        });

        // handle spatie role permission exception
        $this->renderable(function (UnauthorizedException $e, $request) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        });
    }
}
