<?php

namespace App\Repositories\API;

use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): array
    {

        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                throw new Exception('Invalid credentials');
            }
            $user = User::where('email', $request->email)->first();
            return [
                'token' => $user->createToken('auth_token')->plainTextToken,
                'user' => $user
            ];
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function register(RegisterRequest $request) : User
    {

        try {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $user = User::where('email', $request->email)->first();

            $user->sendEmailVerificationNotification();

            return $user;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function verifyEmail($request): JsonResponse
    {
        $user = User::where('id', $request->id)->first();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified'
            ], 200);
        }

        $user->markEmailAsVerified();

        return response()->json([
            'message' => 'Email verified'
        ], 200);
    }

    public function logout(): JsonResponse
    {
        try {
            Auth::user()->tokens()->delete();

            return response()->json([
                'message' => 'Logout successful',
            ], 200);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
