<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\AuthRepository;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private AuthRepository $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $message = $this->authRepository->register($request);

            return response()->json($message, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->authRepository->login($request);

            return response()->json(
                [
                    'message' => 'Login successful',
                    'token' => $data['token'],
                    'user' => new UserResource($data['user'])
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function logout()
    {
        try {
            $this->authRepository->logout();

            return response()->json([
                'message' => 'Logged out'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
    public function verify(EmailVerificationRequest $request)
    {
        try {
            $message = $this->authRepository->verify($request);

            return response()->json($message, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function refresh()
    {
        try {
            $data = $this->authRepository->refresh();

            return response()->json(
                [
                    'message' => 'Token refreshed',
                    'token' => $data['token']
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
