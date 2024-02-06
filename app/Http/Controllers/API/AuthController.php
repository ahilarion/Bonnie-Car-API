<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;
use App\Repositories\API\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->authRepository->login($request);

            return response()->json([
                'message' => 'Login successful',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $data = $this->authRepository->register($request);

            return response()->json([
                'message' => 'Registration successful',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function verifyEmail(Request $request)
    {
        try {
            $this->authRepository->verifyEmail($request);

            return response()->json([
                'message' => 'Email verified',
            ], 200);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function logout()
    {
        try {
            $this->authRepository->logout();

            return response()->json([
                'message' => 'Logout successful',
            ], 200);
        } catch (\Exception $e) {
            // Handle exception
        }
    }
}
