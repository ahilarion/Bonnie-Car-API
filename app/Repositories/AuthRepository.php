<?php

namespace App\Repositories;

use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthRepository {

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request): array
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        if (!$user) {
            throw new \Exception('User not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (!Role::where('name', 'user')->exists()) {
            Role::create(['name' => 'user']);
        }

        $user->assignRole('user');

        $user->sendEmailVerificationNotification();

        return [
            'message' => 'User created successfully and verification email sent'
        ];
    }

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): array
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw new Exception('Invalid credentials', Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user->hasVerifiedEmail()) {
            throw new Exception('Email not verified', Response::HTTP_FORBIDDEN);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }

    /**
     * @throws Exception
     */
    public function verify(EmailVerificationRequest $request): array
    {
        $user = User::find($request->id);

        if (!$user) {
            throw new Exception('User not found', Response::HTTP_NOT_FOUND);
        }

        if ($user->hasVerifiedEmail()) {
            throw new Exception('User already verified', Response::HTTP_BAD_REQUEST);
        }

        $user->markEmailAsVerified();

        return [
            'message' => 'User verified successfully'
        ];
    }

    public function refresh(): array
    {
        Auth::user()->tokens()->delete();

        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token
        ];
    }
}
