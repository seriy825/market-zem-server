<?php

namespace App\Repositories;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create($registerRequest);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }

    public function login(LoginRequest $loginRequest)
    {
        if (!Auth::attempt($loginRequest->only('email', 'password')) || $loginRequest['email']=='admin@groupbwt.com') {
            return response()->json([
                'message' => 'Invalid login details'
            ], 302);
        }
        $user = User::where('email', $loginRequest['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user'=>$user,
            'token'=>$token
        ];
    }

    public function logout()
    {
        return Auth::user()->tokens->delete();
    }
}
