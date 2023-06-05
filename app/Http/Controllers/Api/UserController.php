<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserUpdateRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function user($token)
    {
        $response = $this->userRepository->getUser($token);
        return response()->json($response,$response['status']);
    }
    public function update($id,UserUpdateRequest $registerRequest)
    {
        $response = $this->userRepository->updateUser($id,$registerRequest);
        return response()->json($response,200);
    }
    public function getListingsByUser($id){
        $response = $this->userRepository->getListingsByUser($id);
        return response()->json($response,200);
    }
}
