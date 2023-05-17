<?php

namespace App\Interfaces;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
interface AuthRepositoryInterface
{
    public function register(RegisterRequest $registerRequest);
    public function login(LoginRequest $loginRequest);
    public function logout();
}
