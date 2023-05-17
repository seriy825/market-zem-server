<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private AuthRepositoryInterface $authRepository;
    public function _construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function login(LoginRequest $loginRequest)
    {
        $user = $this->authRepository->login($loginRequest);
        return response()->json($user,200);
    }
    public function register(RegisterRequest $registerRequest)
    {
        $user = $this->authRepository->register($registerRequest);
        return response()->json($user,200);
    }
    public function logout()
    {
        return response()->json($this->authRepository->logout(),200);
    }
}
