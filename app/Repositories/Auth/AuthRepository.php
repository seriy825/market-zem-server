<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create([
            'name'=>$registerRequest->name,
            'email'=>$registerRequest->email,
            'password'=>$registerRequest->password,
            'password_confirmation'=>$registerRequest->password_confirmation,
            'birthdate'=>$registerRequest->birthdate,
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }

    public function login(LoginRequest $loginRequest)
    {
        if (!Auth::attempt($loginRequest->only('email', 'password'))) {
            return [
                'message' => 'Invalid login details'
            ];
        }
        $user = User::where('email', $loginRequest['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }
}
