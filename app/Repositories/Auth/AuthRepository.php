<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

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
            'phone'=>$registerRequest->phone,
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }

    public function login(LoginRequest $loginRequest)
    {
        if (!Auth::attempt($loginRequest->only('email', 'password'))) {
            return [
                'message' => 'Invalid login details',
                'status'=>401,
            ];
        }
        $user = User::where('email', $loginRequest['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $role=null;
        if ($user->email=='admin@marketzem.com') $role='admin';
        return [
            'token'=>$token,
            'role'=>$role,
            'status'=>200
        ];
    }
    public function logout(Request $request){
        PersonalAccessToken::findToken($request->token)->tokenable()->first()->tokens()->delete();
        return [
            'message'=>'Logout success!',
            'status'=>200
        ];
    }
}
