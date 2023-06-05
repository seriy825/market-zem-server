<?php

namespace App\Interfaces;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getUser($token);
    public function updateUser($id,UserUpdateRequest $user);
    public function getListingsByUser($id);
}
